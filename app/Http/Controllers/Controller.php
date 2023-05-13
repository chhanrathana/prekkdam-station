<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use App\Enums\StatusEnum;
use App\Http\Services\Operations\ClientService;
use App\Http\Services\Operations\Deposits\PaymentService as DepositsPaymentService;
use App\Http\Services\Operations\Deposits\RequestService as DepositsRequestService;
use App\Http\Services\Operations\Loans\PaymentService;
use App\Http\Services\Operations\Loans\RequestService;
use App\Http\Services\Settings\PDFService;
use App\Models\LoanPayment;
use App\Models\InterestRate;
use App\Models\ExpenseItem;
use App\Models\Loan;
use App\Models\PaymentRevenue;
use App\Models\PaymentTransaction;
use App\Models\Staff;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $staffService;
    protected $clientService;
    protected $loanRequstService;
    protected $loanPaymentSevice;        
    protected $depositRequstService;
    protected $depositPaymentService;
    protected $pdfService;

    public function __construct()
    {
        // $this->staffService = new StaffService();
        $this->clientService = new ClientService();
        
        $this->loanRequstService = new RequestService();
        $this->loanPaymentSevice = new PaymentService();
        
        $this->depositRequstService = new DepositsRequestService();
        $this->depositPaymentService = new DepositsPaymentService();
        $this->pdfService = new PDFService();
    }

    protected function updateLateTransaction(){
        $today = Carbon::now()->format('Y-m-d');
        LoanPayment::whereDate('end_interest_date', '<', $today)
        ->whereIn('status', ['pending','lack'])
        ->update(['status' =>'late']);
    }
    
    protected function getPaymentStatistic($year = null, $month = null)
    {
        $query = LoanPayment::query();
        $query->when($year, function ($q) use($year) {
            $q->whereYear('end_interest_date', $year);
        });
        $query->when($year, function ($q) use($month) {
            $q->whereMonth('end_interest_date', $month);
        });

        $query->select(DB::raw('count(*) as count, sum(total_amount) as amount,  sum(deduct_amount) as deduct_amount, sum(pending_amount) as pending_amount, status'));

        return $query->groupBy('status')->get();
    }

    protected function getClientStatistic($year = null, $month = null, $brandId = null)
    {
        $query = Client::where('status', StatusEnum::ACTIVE);

        $query->when($brandId && ($brandId <> 'all'), function ($q) use ($brandId) {
            $q->where('branch_id', $brandId);            
        });

        $query->when($year && $month, function ($q) use ($year, $month) {
            $q->whereHas ('loans.payments', function ($q) use ($year, $month) {
                $q->whereYear('end_interest_date', $year);
                $q->whereMonth('end_interest_date', $month);
            });
        });

        return $query->count();
    }

    protected function getInterestType($type){
        return InterestRate::where('code', $type)->first();
    }

    protected function getStaffLoanStatistic($request,  $fromDate, $toDate){
        $brandId = auth()->user()->branch_id??$request->branch_id;        
        
        $queryLoan = Staff::query();
        $queryLoan->select(
            'staffs.id','staffs.name_kh','staffs.branch_id',
            DB::raw('count(loans.id) as count_loans'),
            DB::raw('sum(loans.principal_amount) as total_principal_amount'),
            DB::raw('count(distinct if(clients.`is_new` = 1, loans.id, null )) as count_new'),
            DB::raw('count(distinct if(clients.`is_new` = 0, loans.id, null )) as count_old'),
            DB::raw('sum( case when clients.is_new = 1 then loans.principal_amount else 0 end ) as sum_new'),
            DB::raw('count(distinct if(loans.`status` = \'finish\', loans.id, null )) as finish'),
            DB::raw('count(distinct if(loans.`status` <> \'finish\', loans.id, null )) as progressing'),
        );            
        $queryLoan->leftJoin('loans','staffs.id', 'loans.staff_id');
        $queryLoan->leftJoin('clients','clients.id', 'loans.client_id');        

        $queryLoan->when($brandId && ($brandId <> 'all'), function ($query) use ($brandId) {                    
            $query->where('staffs.branch_id',$brandId);            
        });        

        $queryLoan->when($fromDate, function($query) use($fromDate){
            $query->whereDate('loans.registration_date', '>=', Carbon::parse($fromDate)->format('Y-m-d'));
        });
                  
        $queryLoan->when($toDate, function($query) use($toDate){
            $query->whereDate('loans.registration_date', '<=', Carbon::parse($toDate)->format('Y-m-d'));      
        });
                
        $queryLoan->whereNull('loans.deleted_at');
        $queryLoan->whereNull('clients.deleted_at');
        
        $queryLoan->when($request->name, function ($q) use ($request) {
            $name = mb_strtoupper(trim($request->name));
            $q->where('staffs.name_kh', 'like', '%' . $name . '%');
            $q->orwhere('staffs.name_en', 'like', '%' . $name . '%');
        });

        $queryLoan->groupBy('staffs.id','staffs.name_kh','staffs.branch_id');
        $queryLoan->orderBy('staffs.name_kh','asc');
        return $queryLoan->get();
   }

   protected function getStaffPaymentStatistic($request,  $fromDate, $toDate){        
        $brandId = auth()->user()->branch_id??$request->branch_id;
        
        $queryPayment = LoanPayment::query();
        $queryPayment->select(
            'staffs.id',
            DB::raw('count(distinct loans.id ) as count_pending'),
            DB::raw('count(distinct if(payments.`status` = \'late\' ,loans.id,null )) count_late'),
            DB::raw('sum(if(payments.`status` = \'late\' and payments.deduct_amount >= payments.total_paid_amount,payments.deduct_amount - payments.total_paid_amount,0 )) sum_late_deduction'),
            DB::raw('sum(if(payments.deduct_amount >= payments.total_paid_amount, payments.deduct_amount - payments.total_paid_amount, 0)) as sum_total_pending_deduction')
        );	

        $queryPayment->join('loans','payments.loan_id', 'loans.id');
        $queryPayment->join('staffs','loans.staff_id', 'staffs.id');                

        $queryPayment->when($brandId && ($brandId <> 'all' && auth()->user()->branch_id), function ($query) use ($brandId) {                    
            $query->where('staffs.branch_id',$brandId);            
        });
        
        $queryPayment->when($fromDate, function($query) use($fromDate){
            $query->whereDate('loans.registration_date', '>=', Carbon::parse($fromDate)->format('Y-m-d'));
        });

        $queryPayment->when($toDate, function($query) use($toDate){
            $query->whereDate('loans.registration_date', '<=', Carbon::parse($toDate)->format('Y-m-d'));
        });
        
        $queryPayment->whereNull('payments.deleted_at');
        $queryPayment->whereNull('loans.deleted_at');

        $queryPayment->groupBy('staffs.id');
        $queryPayment->orderBy('staffs.id','asc');
        $payments =  $queryPayment->get();

        return $payments;

   }

   protected function paymentTransaction($payment, $transactionAmount, $type = 'interest', $discountInterestRate = 0){
        
        // payment trx for income report
        $trx = new PaymentTransaction();
        $trx->payment_id = $payment->id;
        $trx->type = $type;
        $trx->transaction_datetime = Carbon::now();
        $trx->transaction_amount = $transactionAmount;

        $sumLastTrxDeductAmount = PaymentTransaction::where('payment_id', $payment->id)->sum('deduct_amount');
        $sumLastTrxInterestAmount = PaymentTransaction::where('payment_id', $payment->id)->sum('interest_amount');
        $pendingDeductAmount = ($payment->deduct_amount - $sumLastTrxDeductAmount);

        // block amount for principal loan first (deduct amount)
        // the raise of amount will separate into interest  
        if($pendingDeductAmount > $trx->transaction_amount){
            $trx->deduct_amount = $trx->transaction_amount;
            $trx->interest_amount = 0 ;
            $trx->revenue_amount = 0;
            $trx->commission_amount = 0;
        }                
        else{
            $trx->deduct_amount = $pendingDeductAmount;
            $trx->revenue_amount = ($trx->transaction_amount - $pendingDeductAmount);
            
            if($payment->interest_amount > $sumLastTrxInterestAmount){
                
                if($trx->revenue_amount > $payment->interest_amount){
                    $trx->interest_amount = $payment->interest_amount - $sumLastTrxInterestAmount;
                }else{
                    $trx->interest_amount =  $trx->revenue_amount;  
                }
            }
            else{
                $trx->interest_amount = 0;
            }            
            
            if($discountInterestRate > 0){
                $discountInterestAmount = $trx->interest_amount * ($discountInterestRate/100);
                $afterDiscountInterestAmount = $trx->interest_amount - $discountInterestAmount;
                $trx->interest_amount = $afterDiscountInterestAmount;
                $trx->revenue_amount = $trx->revenue_amount - $discountInterestAmount;                
            }

            $trx->commission_amount =  $trx->revenue_amount -  $trx->interest_amount;
        }
        

        $trx->save();
    }

    protected function getInterestRevenues($brandId, $fromDate, $toDate){
        $query = PaymentTransaction::query();
        $query->join('payments','payment_transactions.payment_id', 'payments.id');
        $query->join('loans','payments.loan_id', 'loans.id');
        $query->select(            
            'loans.branch_id as branch_id',
            DB::raw('date(payment_transactions.transaction_datetime) as transaction_date'), 
            DB::raw('count(payment_transactions.id) as count_transaction'),
            DB::raw('sum(payment_transactions.transaction_amount) as total_transaction_amount'),
            DB::raw('sum(payment_transactions.deduct_amount) as total_deduct_amount'),
            DB::raw('sum(payment_transactions.interest_amount) as total_interest_amount'),
            DB::raw('sum(payment_transactions.commission_amount) as total_commission_amount'),
            DB::raw('sum(payment_transactions.revenue_amount) as total_revenue_amount'),
        );

        $query->when($brandId && ($brandId <> 'all'), function ($query) use ($brandId) {                    
            $query->where('loans.branch_id',$brandId);            
        });

        $query->whereNull('loans.deleted_at'); 
        $query->whereNull('payments.deleted_at');
        $query->whereNull('payment_transactions.deleted_at');

        $query->whereDate('payment_transactions.transaction_datetime', '>=', Carbon::parse($fromDate)->format('Y-m-d'));
        $query->whereDate('payment_transactions.transaction_datetime', '<=', Carbon::parse($toDate)->format('Y-m-d'));        
        $query->groupBy('loans.branch_id','transaction_date');
        $query->orderBy('transaction_date','desc');
        $payments = $query->get();
        return $payments;
    }

    protected function getAdminFeeRevenues($brandId = null, $fromDate = null, $toDate = null){
        $query = Loan::query();
        $query->select(
            'branch_id', 
            'registration_date',            
            DB::raw('count(id) as transaction'),
            DB::raw('sum(principal_amount) as total_principal_amount'),
            DB::raw('sum(admin_amount) as total_admin_amount'),
        );

        $query->when($brandId && ($brandId <> 'all'), function ($query) use ($brandId) {                    
            $query->where('branch_id',$brandId);            
        });
        
        $query->whereDate('registration_date','>=', Carbon::parse($fromDate)->format('Y-m-d'));
        $query->whereDate('registration_date','<=', Carbon::parse($toDate)->format('Y-m-d'));        
        $query->groupBy('branch_id','registration_date');
        $query->orderBy('registration_date','desc');
        $loans = $query->get();
        return $loans;
    }

    protected function getExpenses($brandId, $fromDate = null, $toDate = null){
        $query = ExpenseItem::query();
        $query->select(
            DB::raw('date(expense_datetime) as expense_date'), 
            DB::raw('sum(amount) as total_amount')
        );
        $query->where('branch_id',$brandId);
        $query->whereDate('expense_datetime', '>=', $fromDate);
        $query->whereDate('expense_datetime', '<=', $toDate);   
        $query->groupBy('expense_date');
        $query->orderBy('expense_date','desc');
        $expenses = $query->get();        
        return $expenses;
    }

    // insert into another table
    protected function calculateRevenues($brandId, $fromDate, $toDate){        
        $adminFees = $this->getAdminFeeRevenues($brandId, $fromDate, $toDate);
        // dd($adminFees);
        foreach($adminFees as $adminFee){
            $trxDate = Carbon::createFromFormat('d/m/Y', $adminFee->registration_date)->format('Y-m-d');
            $revenue = PaymentRevenue::where([
                ['transaction_date', $trxDate],
                ['branch_id', $brandId]
            ])->first();
            if(!$revenue){
                $revenue = new PaymentRevenue();
                $revenue->transaction_date = $trxDate;                
            }            
            $revenue->admin_fee_amount = $adminFee->total_admin_amount;
            $revenue->branch_id = $brandId;
            $revenue->save();
        }

        $interests = $this->getInterestRevenues($brandId, $fromDate, $toDate);
        foreach($interests as $interest){
            $trxDate = Carbon::createFromFormat('d/m/Y', $interest->transaction_date)->format('Y-m-d');
            $revenue = PaymentRevenue::where([
                ['transaction_date', $trxDate],
                ['branch_id', $brandId]
            ])->first();
            if(!$revenue){
                $revenue = new PaymentRevenue();
                $revenue->transaction_date = $trxDate;                
            }
            $revenue->interest_amount = $interest->total_interest_amount;
            $revenue->commission_amount = $interest->total_commission_amount;
            $revenue->branch_id = $brandId;
            $revenue->save();
        }
                
        // clear old expense for update new once
        PaymentRevenue::where('branch_id', $brandId)
        ->whereDate('transaction_date', '>=', $fromDate)
        ->whereDate('transaction_date', '<=', $toDate)
        ->update(['amount' => 0]);

        $expenses = $this->getExpenses($brandId, $fromDate, $toDate);      
        foreach($expenses as $expense){
            $trxDate = Carbon::createFromFormat('d/m/Y', $expense->expense_date)->format('Y-m-d');
            $revenue = PaymentRevenue::where([
                ['transaction_date', $trxDate],
                ['branch_id', $brandId]
            ])->first();
            if(!$revenue){
                $revenue = new PaymentRevenue();
                $revenue->transaction_date = $trxDate;                
            }
            $revenue->amount = $expense->total_amount;
            $revenue->branch_id = $brandId;
            $revenue->save();
        }
        
        $query = PaymentRevenue::query();
        $query->where('branch_id', $brandId);
        $query->where([
            ['transaction_date', '>=',Carbon::parse($fromDate)->format('Y-m-d')],
            ['transaction_date', '<=', Carbon::parse($toDate)->format('Y-m-d')],
        ]);
        $query->orderBy('transaction_date','desc');
        return $query->get();
    }   


    protected function getNetIncome($brandId, $fromDate, $toDate){
        $query = PaymentRevenue::query();
        $query->select(
            DB::raw('sum(admin_fee_amount) as sum_admin_fee_amount'),
            DB::raw('sum(interest_amount) as sum_interest_amount'),
            DB::raw('sum(commission_amount) as sum_commission_amount'),
            DB::raw('sum(amount) as sum_total_expense'),
            DB::raw('(sum(commission_amount) + sum(interest_amount) + sum(admin_fee_amount) ) as total_revenue'),
            DB::raw('(sum(commission_amount) + sum(interest_amount) + sum(admin_fee_amount) - sum(amount) )as net_income'),
        );
        $query->where('branch_id', $brandId);
        $query->where([
            ['transaction_date', '>=',Carbon::parse($fromDate)->format('Y-m-d')],
            ['transaction_date', '<=', Carbon::parse($toDate)->format('Y-m-d')],
        ]);
        $income = $query->first();
        return $income;
    }
}