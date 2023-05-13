<?php

namespace App\Http\Services\Operations\Loans;

use App\Enums\LoanStatusEnum;
use App\Enums\LoanTypeEnum;
use App\Models\LoanPayment;
use App\Enums\PaymentStatusEnum;
use App\Models\Loan;
use Carbon\Carbon;

class PaymentService {
  
    public function createFristPayment($loan)
    {
        // remove first then create new once
        LoanPayment::where('loan_id', $loan->id)->forceDelete();

        // Fexliable loan
        if($loan->loan_type_id == LoanTypeEnum::FLEXIBLE){
            
            $payment = new LoanPayment();
            $payment->loan_id = $loan->id;
            $payment->status = PaymentStatusEnum::PENDING;
            // $payment->transaction_datetime = 0;
            $payment->principal_amount = $loan->balance_amount;
            $payment->start_interest_date = $loan->registration_date;
            $payment->end_interest_date = $loan->start_interest_date;
            $payment->interval = countDay($loan->getRawOriginal('registration_date'), $loan->getRawOriginal('start_interest_date'));
            $payment->interest_rate = $loan->interest_rate;
            /// 100 mean 100% and 30 mean a month
            // $payment->interest_amount = $payment->interval * ($payment->interest_rate /100/30) * $payment->principal_amount;
            $payment->interest_amount =  ($payment->interest_rate /100) * $payment->principal_amount;
            $payment->interest_paid_amount = 0;
            $payment->interest_pending_amount = $payment->interest_amount;
            $payment->deduct_amount = 0;
            $payment->deduct_paid_amount = 0;
            $payment->deduct_pending_amount = 0;
            $payment->loan_amount = 0;
            $payment->balance_amount = $payment->principal_amount + $payment->loan_amount - $payment->deduct_paid_amount;
            $payment->save();
            return $payment;
        }
        else{
                        
            $fixedAmount = ($loan->principal_amount / $loan->term);
            $principalAmount = $loan->principal_amount;
            $startInterestDate = Carbon::createFromFormat('d/m/Y', $loan->registration_date)->format('Y-m-d');
            $endInterestDate = Carbon::createFromFormat('d/m/Y', $loan->start_interest_date)->format('Y-m-d');
            
            for ($i = 0; $i < $loan->term; $i++) {
                
                // trim gab margin at last term
                if($i == $loan->term - 1){
                    $fixedAmount = $principalAmount;
                }

                
                $payment = new LoanPayment();
                $payment->loan_id = $loan->id;
                $payment->principal_amount = $principalAmount;
                $payment->status = PaymentStatusEnum::PENDING;                
                $payment->start_interest_date = Carbon::parse($startInterestDate)->format('d/m/Y') ;
                $payment->end_interest_date = Carbon::parse($endInterestDate)->format('d/m/Y') ;
                $payment->deduct_amount = $fixedAmount;
                $payment->deduct_paid_amount = 0;
                $payment->deduct_pending_amount = $payment->deduct_amount;
                $payment->interval = countDay($startInterestDate, $endInterestDate);
                $payment->interest_rate = $loan->interest_rate;
                // $payment->interest_amount = $payment->interval * ($payment->interest_rate /100/30) * $payment->principal_amount; 
                $payment->interest_amount = ($payment->interest_rate /100) * $payment->principal_amount; 
                $payment->interest_paid_amount = 0;               
                $payment->interest_pending_amount = $payment->interest_amount;
                $payment->balance_amount = $payment->principal_amount - $payment->deduct_amount;                
                $payment->save();
                
                $principalAmount = $payment->balance_amount;
                $startInterestDate = $payment->getRawOriginal('end_interest_date');
                $endInterestDate = Carbon::parse($payment->getRawOriginal('end_interest_date'))->addMonthsWithNoOverflow()->format('Y-m-d');
            }
            return $payment;
        }        
    }

    public function updateFlexiblePayment($request, $id){
        $payment = LoanPayment::where('id', $id)->first();
        $loan = Loan::find($payment->loan->id);

        $payment->transaction_datetime = Carbon::now();
        // $payment->principal_amount = null;
        // $payment->start_interest_date = null;
        // $payment->end_interest_date = null;
        // $payment->interval = null;
        // $payment->interest_rate = null;
        // $payment->interest_amount = null;
        $payment->interest_paid_amount = $request->interest_paid_amount;
        // $payment->interest_pending_amount = null;
        // $payment->deduct_amount = null;
        $payment->deduct_paid_amount = $request->deduct_paid_amount;
        // $payment->deduct_pending_amount = null;
        $payment->loan_amount = $request->loan_amount;
        $payment->balance_amount = $loan->balance_amount + $payment->loan_amount - $payment->deduct_paid_amount;
        $payment->status = PaymentStatusEnum::PAID;
        $payment->save();

        $loan->status = LoanStatusEnum::PROGRESS;
        $loan->update_balance_date = Carbon::now();
        $loan->balance_amount =  $payment->balance_amount;

        if($loan->balance_amount <= 0){
            $loan->status = LoanStatusEnum::FINISH;
            $loan->finish_date = Carbon::now();
        }
        $loan->save();

        if($loan->balance_amount > 0){
            $startInterestDate = $payment->getRawOriginal('end_interest_date');
            $endInterestDate = Carbon::parse($startInterestDate)->addMonthNoOverflow()->format('Y-m-d');
    
            $nextPayment = new LoanPayment();
            $nextPayment->loan_id = $loan->id;
            // $nextPayment->transaction_datetime = Carbon::now();
            $nextPayment->principal_amount = $loan->balance_amount;
            $nextPayment->start_interest_date = Carbon::parse($startInterestDate)->format('d/m/Y') ;
            $nextPayment->end_interest_date = Carbon::parse($endInterestDate)->format('d/m/Y') ;
            $nextPayment->interval = countDay($startInterestDate, $endInterestDate);
            $nextPayment->interest_rate = $loan->interest_rate;
            // $nextPayment->interest_amount = $nextPayment->interval * ($nextPayment->interest_rate /100/30) * $nextPayment->principal_amount;;
            $nextPayment->interest_amount = ($nextPayment->interest_rate /100) * $nextPayment->principal_amount;
            $nextPayment->interest_paid_amount = 0;
            $nextPayment->interest_pending_amount = $nextPayment->interest_amount + $payment->interest_pending_amount - $payment->interest_paid_amount;
            $nextPayment->deduct_amount = 0;
            $nextPayment->deduct_paid_amount = 0;
            $nextPayment->deduct_pending_amount = 0;
            $nextPayment->loan_amount = 0;
            $nextPayment->balance_amount = $loan->balance_amount;
            $nextPayment->status = PaymentStatusEnum::PENDING;
            $nextPayment->save();
        }        
        return $loan;
    }
    
    public function updateFixPayment($request, $id)
    {
        $payment = LoanPayment::where('id', $id)->first();        
        $loan = Loan::find($payment->loan->id);
                    
        $payment->transaction_datetime = Carbon::now();        
        $payment->interest_paid_amount = $request->interest_paid_amount;        
        $payment->deduct_paid_amount = $request->deduct_paid_amount;        
        $payment->balance_amount = $loan->balance_amount + $request->loan_amount - $payment->deduct_paid_amount;
        $payment->status = PaymentStatusEnum::PAID;
        $payment->save();

        $loan->status = LoanStatusEnum::PROGRESS;
        $loan->update_balance_date = Carbon::now();
        $loan->balance_amount =  $payment->balance_amount;

        if($loan->balance_amount <= 0){
            $loan->status = LoanStatusEnum::FINISH;
            $loan->finish_date = Carbon::now();
        }
        $loan->save();
        return $loan;
    }

    public function getPayments($request)
    {

        $paymentDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->end_interest_date)->format('Y-m-d') : null;
        
        $query = LoanPayment::query();
        
        $query->when($paymentDate, function ($q) use ($paymentDate) {
            $q->where('end_interest_date', '<=', $paymentDate);
        });

        $query->when($request->deposit_code, function ($q) use ($request) {    
            $code = mb_strtoupper(trim($request->deposit_code));        
            $q->whereHas('laon', function ($q) use ($code) {
                $q->where('code', $code);
            });
        });

        $query->when($request->name, function ($q) use ($request) {
            $name = mb_strtoupper(trim($request->name));
            $q->whereHas('laon.client', function ($q) use ($name) {
                $q->where('name_kh', 'like', '%' . $name . '%');
                $q->orwhere('name_en', 'like', '%' . $name . '%');
            });
        });
      
        $query->where('status', PaymentStatusEnum::PENDING);
        $query->where('principal_amount', '>', 0);
        $query->orderBy('end_interest_date');
        return $query->get();
    } 
}