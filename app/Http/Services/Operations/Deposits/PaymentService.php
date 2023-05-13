<?php

namespace App\Http\Services\Operations\Deposits;

use App\Enums\DepositStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Deposit;
use App\Models\DepositPayment;
use Carbon\Carbon;

class PaymentService
{
    
    public function createFristPayment($deposit)
    {
        // remove first then create new once
        DepositPayment::where('deposit_id', $deposit->id)->forceDelete();

        $payment = new DepositPayment();
        $payment->deposit_id = $deposit->id;
        $payment->status = PaymentStatusEnum::PENDING;
        $payment->principal_amount = $deposit->balance_amount;
        $payment->start_interest_date = $deposit->registration_date;
        $payment->end_interest_date = $deposit->start_interest_date;
        $payment->interval = countDay($deposit->getRawOriginal('registration_date'), $deposit->getRawOriginal('start_interest_date'));
        $payment->interest_rate = $deposit->interest_rate;
        /// 100 mean 100% and 30 mean a month
        // $payment->interest_amount = $payment->interval * ($payment->interest_rate /100/30) * $payment->principal_amount;
        $payment->interest_amount =($payment->interest_rate /100) * $payment->principal_amount;
        $payment->withdraw_amount = 0;
        $payment->deposit_amount = 0;
        $payment->balance_amount = $payment->principal_amount + $payment->interest_amount + $payment->deposit_amount - $payment->withdraw_amount;
        $payment->save();
        return $payment;
    }

    public function updateSavingPayment($request, $id)
    {
        $payment = DepositPayment::find($id);
        $payment->transaction_datetime = Carbon::now();
        $payment->status = PaymentStatusEnum::PAID;        
        $payment->withdraw_amount = $request->withdraw_amount;
        $payment->deposit_amount = $request->deposit_amount;
        $payment->balance_amount = $payment->principal_amount + $payment->interest_amount + $payment->deposit_amount - $payment->withdraw_amount;
        $payment->save();
        
        $deposit = Deposit::find($payment->deposit_id);        
        $deposit->update_balance_date = Carbon::now();
        $deposit->balance_amount = $payment->balance_amount;
        $deposit->status = DepositStatusEnum::PROGRESS; 
        if($deposit->balance_amount <= 0){
            $deposit->status = DepositStatusEnum::FINISH; 
            $deposit->finish_date = Carbon::now();
        }
        $deposit->save();

        if($deposit->balance_amount > 0){
            $startInterestDate = $payment->getRawOriginal('end_interest_date');
            $endInterestDate = Carbon::parse($startInterestDate)->addMonthNoOverflow()->format('Y-m-d');
        
            $nextPayment = new DepositPayment();
            $nextPayment->deposit_id = $deposit->id;
            $nextPayment->status = PaymentStatusEnum::PENDING;
            
            $nextPayment->principal_amount = $deposit->balance_amount;
            $nextPayment->start_interest_date = Carbon::parse($startInterestDate)->format('d/m/Y') ;
            $nextPayment->end_interest_date = Carbon::parse($endInterestDate)->format('d/m/Y') ;
            $nextPayment->interval = countDay($startInterestDate, $endInterestDate);
            $nextPayment->interest_rate = $deposit->interest_rate;
            /// 100 mean 100% and 30 mean a month
            // deposit use first principal amount to calculate interest
            $nextPayment->withdraw_amount = 0;
            $nextPayment->deposit_amount = 0;
            // $nextPayment->interest_amount = $nextPayment->interval * ($nextPayment->interest_rate /100/30) * $nextPayment->principal_amount;
            $nextPayment->interest_amount =  ($nextPayment->interest_rate /100) * $nextPayment->principal_amount;
            $nextPayment->balance_amount = $deposit->balance_amount + $nextPayment->interest_amount;
            $nextPayment->save();
        }
      
        return $deposit;
    }

    public function updateDepositPayment($request, $id)
    {
        $payment = DepositPayment::find($id);
        $payment->transaction_datetime = Carbon::now();
        $payment->status = PaymentStatusEnum::PAID;        
        $payment->withdraw_amount = $request->withdraw_amount;
        $payment->deposit_amount = $request->deposit_amount;
        $payment->balance_amount = $payment->principal_amount + $payment->interest_amount + $payment->deposit_amount - $payment->withdraw_amount;
        $payment->save();
        
        $deposit = Deposit::find($payment->deposit_id);        
        $deposit->update_balance_date = Carbon::now();
        $deposit->balance_amount = $payment->balance_amount;
        $deposit->status = DepositStatusEnum::PROGRESS; 
        if($deposit->balance_amount <= 0){
            $deposit->status = DepositStatusEnum::FINISH; 
            $deposit->finish_date = Carbon::now();
        }
        $deposit->save();

        if($deposit->balance_amount > 0){
            $startInterestDate = $payment->getRawOriginal('end_interest_date');
            $endInterestDate = Carbon::parse($startInterestDate)->addMonthNoOverflow()->format('Y-m-d');
        
            $nextPayment = new DepositPayment();
            $nextPayment->deposit_id = $deposit->id;
            $nextPayment->status = PaymentStatusEnum::PENDING;
            
            $nextPayment->principal_amount = $deposit->balance_amount;
            $nextPayment->start_interest_date = Carbon::parse($startInterestDate)->format('d/m/Y') ;
            $nextPayment->end_interest_date = Carbon::parse($endInterestDate)->format('d/m/Y') ;
            $nextPayment->interval = countDay($startInterestDate, $endInterestDate);
            $nextPayment->interest_rate = $deposit->interest_rate;
            /// 100 mean 100% and 30 mean a month
            // deposit use first principal amount to calculate interest
            $nextPayment->withdraw_amount = 0;
            $nextPayment->deposit_amount = 0;
            // $nextPayment->interest_amount = $nextPayment->interval * ($nextPayment->interest_rate /100/30) * ($deposit->principal_amount - $payment->withdraw_amount);
            $nextPayment->interest_amount = ($nextPayment->interest_rate /100) * ($deposit->principal_amount - $payment->withdraw_amount);
            $nextPayment->balance_amount = ($deposit->balance_amount  + $nextPayment->interest_amount);        
            $nextPayment->save();
        }
      
        return $deposit;
    }

    public function getPayments($request)
    {

        $paymentDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->end_interest_date)->format('Y-m-d') : null;
        
        $query = DepositPayment::query();
        $query->when($paymentDate, function ($q) use ($paymentDate) {
            $q->where('end_interest_date', '<=', $paymentDate);
        });

        $query->when($request->deposit_code, function ($q) use ($request) {    
            $code = mb_strtoupper(trim($request->deposit_code));        
            $q->whereHas('deposit', function ($q) use ($code) {
                $q->where('code', $code);
            });
        });

        $query->when($request->name, function ($q) use ($request) {
            $name = mb_strtoupper(trim($request->name));
            $q->whereHas('deposit.client', function ($q) use ($name) {
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