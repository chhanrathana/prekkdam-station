<?php

namespace App\Http\Controllers\Operations\Purchases;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Loan;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoanExport;
use App\Http\Requests\OilPurchaseRequest;
use App\Models\OilPurchase;

class RequestController extends Controller
{    
    public function index(Request $request)
    {
        $records = $this->purchaseRequstService->getPurchases($request);

        return view('operations.purchases.requests.index',[
            'records' => $records,
            'types'   => $this->getOilTypes(),
        ]);
    }

    public function create()
    {                         
        return view('operations.purchases.requests.create', [
            'currentDate'   => $this->currentDate,
            'types'         => $this->getOilTypes(),
            'code'          => generateOilPurchaseCode(),
            'statuses'      => $this->getOilStatuses(),
        ]);
    }
 
    public function store(OilPurchaseRequest $request)
    {
        DB::beginTransaction();
        try {                      
            $record = $this->purchaseRequstService->createPurchase($request);
            DB::commit();
            return redirect()->back()->with('success', __('message.success').' '.__('form.purchase_code').' '. $record->code);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $record = OilPurchase::find($id);

        return view('operations.purchases.requests.edit', [
            'currentDate'   => $this->currentDate,
            'types'         => $this->getOilTypes(),
            'statuses'      => $this->getOilStatuses(),
            'record'        => $record,
        ]);
    }

    public function update(OilPurchaseRequest $request, $id)
    {
        DB::beginTransaction();
        try {            
            $this->purchaseRequstService->createPurchase($request);
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function show($id)
    {
        $record = OilPurchase::find($id);        
        
        return view('operations.purchases.requests.show',[
            'record' => $record,
        ]);
    } 

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $record = OilPurchase::find($id);
            $record->delete();        
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function export(Request $request)
    {
        $data = Loan::find($request->id);
        return Excel::download(new LoanExport($data), 'loan_payment.xlsx');
    }   
}