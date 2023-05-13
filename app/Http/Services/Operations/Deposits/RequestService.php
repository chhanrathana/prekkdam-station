<?php

namespace App\Http\Services\Operations\Deposits;

use App\Enums\DepositStatusEnum;
use App\Enums\LoanStatusEnum;
use App\Models\Deposit;
use Carbon\Carbon;

class RequestService
{
    private function generateDepositCode()
    {
       $count = Deposit::count();
       $code = (1 + $count);
        return str_pad($code, 5, '0', STR_PAD_LEFT);
    }

    public function removeLoan($id){
        Deposit::where('id', $id)->where('status', LoanStatusEnum::PENDING)->delete();
    }

    public function createDeposit($request, $client)
    {
        $deposit = Deposit::find($request->deposit_id);
        if (!$deposit) {
            $deposit = new Deposit();
            $deposit->code = $this->generateDepositCode();
        }
        $deposit->fill($request->only([
            'principal_amount', 'term', 'registration_date', 'start_interest_date', 'staff_id','interest_rate','deposit_type_id','admin_fee_amount'
        ]));
        $registrationDate = Carbon::createFromFormat('d/m/Y', $request->registration_date)->format('Y-m-d');        
        $deposit->interest_rate = $request->interest_rate;        
        $deposit->update_balance_date = $registrationDate;
        $deposit->balance_amount = $request->principal_amount;
        $deposit->client_id = $client->id;
        $deposit->status = DepositStatusEnum::PENDING;
        $deposit->save();
        return $deposit;
    }

    public function getDeposits($request, $paginate = true, $decution = false, $history = false)
    {
        $query = Deposit::query();
       
        // if($decution){
        //     $query->where('status', '<>',LoanStatusEnum::FINISH);
        // }

        $query->when($request->branch_id && ($request->branch_id <> 'all'), function ($q) use ($request) {
            $q->where('branch_id', $request->branch_id);            
        });
        

        $query->when($request->staff_id , function($q , $staff){
            $q->where('staff_id','=',$staff);
        });

        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d') : null;
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date)->format('Y-m-d') : null;

        $query->when($fromDate, function ($q) use ($fromDate) {
            $q->where('registration_date', '>=', $fromDate);
        });

        $query->when($toDate, function ($q) use ($toDate) {
            $q->where('registration_date', '<=', $toDate);
        });

        $query->when($request->name, function ($q) use ($request) {
            $name = mb_strtoupper(trim($request->name));
            $q->whereHas('client', function ($q) use ($name) {
                $q->where('name_kh', 'like', '%' . $name . '%');
                $q->orwhere('name_en', 'like', '%' . $name . '%');
            });
        });

        $query->when($request->interest_rate_id && strtolower($request->interest_rate_id) != 'all', function ($q) use ($request) {
            $q->where('interest_rate_id', $request->interest_rate_id);
        });
        
        if ($history){
            $query->where('status','=','finish');
        }else{
            $query->when($request->status && strtolower($request->status) != 'all', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $query->when($request->client_code, function ($q) use ($request) {
            $q->whereHas('client', function ($q) use ($request) {
                $q->where('code', $request->client_code);
            });
        });

        $query->orderByDesc('updated_at');
        
        if ($paginate) {
            return $query->paginate(env('PAGINATION'));
        }
        return $query->get();
    }    
}