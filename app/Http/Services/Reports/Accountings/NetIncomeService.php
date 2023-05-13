<?php

namespace App\Http\Services\Reports\Accountings;

use App\Enums\PaymentStatusEnum;
use App\Models\DepositPayment;
use App\Models\LoanPayment;
use Illuminate\Support\Facades\DB;

class NetIncomeService
{
    
    public function getInterestRevenue($request){
        $query = LoanPayment::query();
        $query->where('status', PaymentStatusEnum::PAID);
        $query->select(DB::raw('count(*) as count, sum(interest_amount) as total_interest_amount'));
        return $query->first();
    }

    public function getInterestExpense($request){
        $query = DepositPayment::query();
        $query->where('status', PaymentStatusEnum::PAID);
        $query->select(DB::raw('count(*) as count, sum(interest_amount) as total_interest_amount'));
        return $query->first();
    }
}