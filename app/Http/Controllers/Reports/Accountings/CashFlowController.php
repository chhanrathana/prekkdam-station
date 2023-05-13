<?php

namespace App\Http\Controllers\Reports\Accountings;

use App\Http\Controllers\Controller;
use App\Http\Services\Reports\Accountings\CashFlowService;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    private $cashFlowService;
    
    public function __construct()
    {
        $this->cashFlowService = new CashFlowService();
    }

    public function index(Request $request)
    {
        $loanCashIn = $this->cashFlowService->getLoanCashIn($request);
        $depositCashIn = $this->cashFlowService->getDepositCashIn($request);

        return view('reports.accountings.cashflows.index',[
            'loanCashIn' => $loanCashIn,
            'depositCashIn' => $depositCashIn
        ]);
    }

}
