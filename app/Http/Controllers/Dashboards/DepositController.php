<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanPayment;

class DepositController extends Controller
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
