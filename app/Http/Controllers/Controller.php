<?php

namespace App\Http\Controllers;

use App\Enums\ActiveEnum;
use App\Enums\OilStatusEnum;
use App\Enums\StatusEnum;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Operations\ClientService;
use App\Http\Services\Operations\Sales\PaymentService;
use App\Http\Services\Operations\Sales\RequestService;
use App\Http\Services\Operations\Purchases\RequestService as PurchasesRequestService;
use App\Http\Services\Operations\PurchaseService;
use App\Http\Services\Operations\SaleService;
use App\Http\Services\Settings\PDFService;
use App\Models\Client;
use App\Models\LoanPayment;
use App\Models\ExpenseItem;
use App\Models\OilStatus;
use App\Models\OilType;
use App\Models\PaymentRevenue;
use App\Models\Staff;
use App\Models\Vendor;
use App\Models\WorkShift;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $staffService;
    protected $clientService;
    protected $saleService;
    protected $salePaymentSevice;        
    protected $purchaseService;
    protected $depositPaymentService;
    protected $pdfService;
    protected $currentDate;

    public function __construct()
    {
        $this->clientService = new ClientService();        
        $this->saleService = new SaleService();       
        $this->purchaseService = new PurchaseService();     
        $this->currentDate = Carbon::now()->format('d/m/Y');
    }
    
    protected function updateLateTransaction(){
        $today = Carbon::now()->format('Y-m-d');
        LoanPayment::whereDate('end_interest_date', '<', $today)
        ->whereIn('status', ['pending','lack'])
        ->update(['status' =>'late']);
    }

    protected function getOilTypes(){        
        return OilType::where('active', ActiveEnum::YES)->orderBy('id')->get();
    }

    protected function getActiveVndors(){        
        return Vendor::where('status', StatusEnum::ACTIVE)->orderBy('name_kh')->get();
    }

    protected function getActiveClients(){        
        return Client::where('status', StatusEnum::ACTIVE)->orderBy('name_kh')->get();
    }

    protected function getActiveStaffs(){
        return Staff::where('status', StatusEnum::ACTIVE)->orderBy('name_kh')->get();
    }

    protected function getOilStatuses(){        
        return OilStatus::where('active', ActiveEnum::YES)->orderBy('id')->get();
    }

    protected function getWorkShifts(){
        return WorkShift::where('active', ActiveEnum::YES)->orderBy('id')->get();
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

    protected function getOnsaleOils(){
        $query = OilType::join('oil_purchases', 'oil_types.id', 'oil_purchases.oil_type_id');
        $query->where('oil_purchases.status_id', OilStatusEnum::ON_SALE);
        return $query->get(['oil_purchases.id', 'oil_types.name_kh', 'oil_types.name_en', DB::raw('(oil_purchases.remain_qty * oil_types.liter_of_ton) as remain_qty'), 'oil_purchases.code']);
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