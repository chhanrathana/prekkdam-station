<?php

namespace App\Http\Controllers\Operations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\Settings\DownloadService;
use App\Models\OilSale;
use App\Models\OilPurchase;

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
            'tanks'         => $this->getActiveTanks(),
        ]);
    }
 
    public function store(Request $request)
    {        
        $request->validate([
            'date' => 'date_format:d/m/Y',            
            'work_shift_id' =>'required',
            'oil_purchase_id' => 'required',
            'tank_id' =>'required',
            'staff_id' =>'required',
            'client_id' =>'required',
            // 'old_motor_right' => 'required|numeric',
            // 'new_motor_right' => 'required|numeric|gte:old_motor_right',
            // 'old_motor_left' => 'required|numeric',
            // 'new_motor_left' => 'required|numeric|gte:old_motor_left',
            'qty' => 'required',
            'price' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {                  
            $oilPurchase = OilPurchase::where('id', $request->oil_purchase_id)->first();

            // $qty = ($request->new_motor_right - $request->old_motor_right) + ($request->new_motor_left - $request->old_motor_left);

            $saleQty = $oilPurchase->sales->sum('qty')??0;
            
            // qty not enougl
            if(($oilPurchase->qty - $saleQty  - $request->qty ) < 0){
                return redirect()->back()->with('error', 'បរិមាណប្រេងលើសស្តុក!');
            }

            $this->saleService->createSale($request, $oilPurchase); 
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
            'tanks'         => $this->getActiveTanks(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'date_format:d/m/Y',            
            'work_shift_id' =>'required',
            'tank_id' =>'required',
            'staff_id' =>'required',
            'client_id' =>'required',
            'oil_purchase_id' => 'required',
            // 'old_motor_right' => 'required|numeric',
            // 'new_motor_right' => 'required|numeric|gte:old_motor_right',
            // 'old_motor_left' => 'required|numeric',
            // 'new_motor_left' => 'required|numeric|gte:old_motor_left',
            'qty' => 'required',
            'price' => 'required|numeric',
        ]);
        DB::beginTransaction();
        try {            
            $oilPurchase = OilPurchase::where('id', $request->oil_purchase_id)->first();

            // $qty = ($request->new_motor_right - $request->old_motor_right) + ($request->new_motor_left - $request->old_motor_left);
            $saleQty = $oilPurchase->sales->sum('qty')??0;
            // qty not enougl
            if(($oilPurchase->qty - $saleQty  - $request->qty ) < 0){
                return redirect()->back()->with('error', 'បរិមាណប្រេងលើសស្តុក!');
            }

            $this->saleService->createSale($request, $oilPurchase); 
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

    public function print($id)
    {
        $record = OilSale::find($id);        
        $html = view('operations.sales.pdf',[
            'record' =>$record,
        ]);
        return DownloadService::PDF($html, $title = 'របាការណ៍', $orientation = 'P', $font = 12, $printCard = false, $mt = 2, $ml = 2, $mr = 2, $format = 'A5');        
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

    public function getMotor(Request $request)
    {                       
        $record = OilSale::where('oil_purchase_id', $request->oil_purchase_id)
        ->orderByDesc('date')
        ->first(['old_motor_right', 'new_motor_right', 'old_motor_left', 'new_motor_left']);
        return response()->json(['record' => [
            'new_motor_left' =>  $record->new_motor_left??0,
            'new_motor_right' => $record->new_motor_right??0,
        ]]);
    }
}