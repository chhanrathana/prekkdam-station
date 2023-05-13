<?php

namespace App\Http\Controllers\Dashboards;

use App\Enums\LoanStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\InterestRate;
use App\Models\Loan;
use App\Models\LoanPayment;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        
        
        return view('dashboards.loans.index',[
            // 'branches' => Branch::all(),
            'interests' => null,
        ]);
    }


    private function recoverseErrorData(){
        $loans = Loan::where('status', 'finish')
        ->where('finish_discount','>', 0)
        ->get();
        // dd($loans->toArray());
        foreach($loans as $loan){
            $interest = LoanPayment::where('loan_id', $loan->id)
            ->where('status', 'finish')        
            ->sum('interest_amount');                                

            $updateLoan = Loan::find($loan->id);
            $discount = $interest * ((100 - $loan->finish_discount )/100);                        
            $updateLoan->finish_discount_amount = $discount;
            $updateLoan->save();

            echo "<br/> ".$updateLoan->id ." | ".number_format($interest).' | '.number_format($updateLoan->finish_discount_amount);
        }
        exit;
        // dd($loans->toArray());
    }
}
