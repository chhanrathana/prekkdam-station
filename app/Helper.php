<?php

use App\Models\ExchangeRate;
use App\Models\OilPurchase;
use App\Models\OilSale;
use App\Models\OilType;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

function convertDaytoKhmer($weekDay)
{
    $day = ['Sun' => 'អាទិត្យ', 'Mon' => 'ច័ន្ទ', 'Tue' => 'អង្គារ៍', 'Wed' => 'ពុធ', 'Thu' => 'ព្រ.ហ', 'Fri' => 'សុក្រ', 'Sat' => 'សៅរ៍'];
    return $day[$weekDay];
}

function generateOilPurchaseCode()
{
    $count = OilPurchase::withTrashed()->count();
    $code = (1 + $count);
    return 'P'.str_pad($code, 4, '0', STR_PAD_LEFT);
}

function generateOilSaleCode()
{
    $count = OilSale::withTrashed()->count();
    $code = (1 + $count);
    return 'S'.str_pad($code, 4, '0', STR_PAD_LEFT);
}

function getExchangeRate($date){
    $record = ExchangeRate::where('date', $date)->first();
    if(!$record){
        // new new once if null
        $lastUpdate = ExchangeRate::orderByDesc('date')->first();
        $record = new ExchangeRate();
        $record->date = $date;
        $record->usd = $lastUpdate->usd;
        $record->khr = $lastUpdate->khr;
        $record->save();
    }
    return $record->khr;
}

function getLiterOfTon($id){
    $record = OilType::where('id', $id)->first();
    return $record->liter_of_ton;
}

function currentParamter(){	
	return  str_replace(url()->current(),'',url()->full());
}

function countDay($startDate, $endDate){    
    $endDate = Carbon::parse($endDate);
    $startDate = Carbon::parse($startDate);
    $days = $endDate->diff($startDate)->days;
    return $days;
}

function getBackupData($name){
    $file = json_decode(file_get_contents(base_path('database/seeders/Data/20220520_kunpukqp_loan.json')), true);        
    foreach ($file as $item) {            
        if($item['type'] == 'table' && $item['name'] == $name){
            return $item['data'];                
        }
    }
}

function paymentTransaction($payment, $transactionAmount, $type = 'interest'){
        
    // payment trx for income report
    $trx = new PaymentTransaction();
    $trx->payment_id = $payment->id;
    $trx->type = $type;

    $paidDate = $payment->last_payment_paid_date?$payment->last_payment_paid_date:$payment->end_interest_date;
    
    $trx->transaction_datetime = Carbon::createFromFormat('d/m/Y', $paidDate)->format('Y-m-d');
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
        $trx->commission_amount =  $trx->revenue_amount -  $trx->interest_amount;
    }
    $trx->save();
}

function uploadImage($base64, $dir = 'avatars'){    
    $image = str_replace('data:image/png;base64,', '', $base64);
    $image = str_replace(' ', '+', $image);
    $imageUrl = $dir. '/'. Str::uuid().'.'.'png';
    Storage::disk('local')->put('public/'.$imageUrl, base64_decode($image));
    return 'storage/'.$imageUrl;
}

function formatToOrignDate($date){
    return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
}