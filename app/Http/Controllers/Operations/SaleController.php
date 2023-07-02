<?php

namespace App\Http\Controllers\Operations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OilSale;

class SaleController extends Controller
{        
    public function index(Request $request)
    {
        $records = $this->saleService->getSales($request);
        return view('operations.sales.index',[            
            'records'   => $records,
            'types'   => $this->getOilTypes(),
        ]);
    }

    public function create()
    {                       
        return view('operations.sales.create', [
            'code'          => generateOilSaleCode(),
            'currentDate'   => $this->currentDate,
            'types'         => $this->getOnsaleOils(),
            'shifts'        => $this->getWorkShifts(),
            'clients'       => $this->getActiveClients(),
            'staffs'        => $this->getActiveStaffs(),
        ]);
    }
 
    public function store(Request $request)
    {        
        $request->validate([
            'date' => 'date_format:d/m/Y',            
            'work_shift_id' =>'required',
            'oil_purchase_id' => 'required',
            'staff_id' =>'required',
            'client_id' =>'required',
            'old_motor_right' => 'required|numeric',
            'new_motor_right' => 'required|numeric|gte:old_motor_right',
            'old_motor_left' => 'required|numeric',
            'new_motor_left' => 'required|numeric|gte:old_motor_left',
            'price' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {                     
            $this->saleService->createSale($request); 
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

        return view('operations.sales.edit', [
            'record'        => $record,
            'types'         => $this->getOnsaleOils(),
            'shifts'        => $this->getWorkShifts(),
            'clients'       => $this->getActiveClients(),
            'staffs'        => $this->getActiveStaffs(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'date_format:d/m/Y',            
            'work_shift_id' =>'required',
            'staff_id' =>'required',
            'client_id' =>'required',
            'oil_purchase_id' => 'required',
            'old_motor_right' => 'required|numeric',
            'new_motor_right' => 'required|numeric|gte:old_motor_right',
            'old_motor_left' => 'required|numeric',
            'new_motor_left' => 'required|numeric|gte:old_motor_left',
            'price' => 'required|numeric',
        ]);
        DB::beginTransaction();
        try {            
            $this->saleService->createSale($request); 
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

        return view('operations.sales.show',[
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