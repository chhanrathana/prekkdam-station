<?php

namespace App\Http\Controllers\Reports\Accountings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        return view('reports.accountings.expenses.index',[
         
        ]);
    }

}
