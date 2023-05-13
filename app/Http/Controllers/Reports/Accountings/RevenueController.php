<?php

namespace App\Http\Controllers\Reports\Accountings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        return view('reports.accountings.revenues.index',[
            // 'branches' => Branch::all(),
            'interests' => null,
        ]);
    }

}
