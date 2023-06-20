<?php

namespace App\Http\Controllers\Operations\Sales;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\OilSaleRequest;
use App\Models\OilSale;

class RequestController extends Controller
{        
    public function index(Request $request)
    {
        $records = $this->saleRequstService->getSales($request);
        return view('operations.sales.requests.index',[            
            'records'   => $records,
            'types'   => $this->getOilTypes(),
        ]);
    }

    public function create()
    {                       
        return view('operations.sales.requests.create', [
            'code'          => generateOilSaleCode(),
            'currentDate'   => $this->currentDate,
            'types'         => $this->getOnsaleOils(),
            'shifts'        => $this->getWorkShifts(),
        ]);
    }
 
    public function store(OilSaleRequest $request)
    {        
        DB::beginTransaction();
        try {          
            $this->saleRequstService->createSale($request); 
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $record = OilSale::find($id);

        return view('operations.sales.requests.edit', [
            'record' => $record,
            'types' => $this->getOnsaleOils(),
            'shifts'=> $this->getWorkShifts(),
        ]);
    }

    public function update(OilSaleRequest $request, $id)
    {
        DB::beginTransaction();
        try {            
            $this->saleRequstService->createSale($request); 
            DB::commit();            
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function show($id)
    {
        $record = OilSale::find($id);

        return view('operations.sales.requests.show',[
            'record' => $record
        ]);
    } 

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $record = OilSale::find($id);
            $record->delete();        
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }    
}