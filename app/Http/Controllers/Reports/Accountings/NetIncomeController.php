<?php

namespace App\Http\Controllers\Reports\Accountings;

use App\Http\Controllers\Controller;
use App\Http\Services\Reports\Accountings\NetIncomeService;
use Illuminate\Http\Request;

class NetIncomeController extends Controller
{
    private $netIncomeService;
    
    public function __construct()
    {
        $this->netIncomeService = new NetIncomeService();
    }
    
    public function index(Request $request)
    {
        $interestRevenue  = $this->netIncomeService->getInterestRevenue($request);
        $interestExpense  = $this->netIncomeService->getInterestExpense($request);

        return view('reports.accountings.netincomes.index',[
            'interestRevenue' => $interestRevenue,
            'interestExpense' => $interestExpense
        ]);
    }

}
