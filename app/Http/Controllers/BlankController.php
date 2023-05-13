<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanPayment;

class BlankController extends Controller
{
    public function index(Request $request)
    {                
        return view('blanks.index',[
        
            'interests' => null,
        ]);
    }

    public function create(Request $request)
    {                
        return view('blanks.index',[
        
            'interests' => null,
        ]);
    }
}
