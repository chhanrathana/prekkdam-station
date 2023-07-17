<?php

namespace App\Http\Controllers\Reports\Purchases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {        
        return view('reports.purchases.stock.index',[
            'records'  => $this->getOilTypes(),
        ]);
    }   
}
