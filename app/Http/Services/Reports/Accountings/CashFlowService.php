<?php

namespace App\Http\Services\Reports\Accountings;

use App\Enums\PaymentStatusEnum;
use App\Models\DepositPayment;
use App\Models\LoanPayment;
use Illuminate\Support\Facades\DB;

class CashFlowService
{
    
    public function getLoanCashIn($request){
        $query = LoanPayment::query();
        $query->where('status', PaymentStatusEnum::PAID);
        $query->select(DB::raw('count(*) as count, sum(interest_paid_amount) as total_interest_paid_amount, sum(deduct_paid_amount) as total_deduct_paid_amount'));
        return $query->first();
    }

    public function getDepositCashIn($request){
        $query = DepositPayment::query();
        $query->where('status', PaymentStatusEnum::PAID);
        $query->select(DB::raw('count(*) as count, sum(deposit_amount) as total_deposit_amount'));
        return $query->first();
    }

    // public function getInterestExpense($request){
    //     $query = DepositPayment::query();
    //     $query->where('status', PaymentStatusEnum::PAID);
    //     $query->select(DB::raw('count(*) as count, sum(interest_amount) as total_interest_amount'));
    //     return $query->first();
    // }
}