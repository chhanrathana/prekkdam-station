<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\VehicleRequest;
use App\Models\Dividends\Indicator;
use App\Models\Dividends\SetlementAccount;
use App\Models\MasterData\Vehicle;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    
    public function index()
    {        
        $items = Vehicle::all();        
        return view('settings.vehicles.index', [
            'items' => $items
        ]);
    }
   
    public function create()
    {
        return view('settings.vehicles.create', [
        ]);
    }
  
    public function store(VehicleRequest $request)
    {       

        DB::beginTransaction();
        try {            
            $model = new Vehicle();
            $model->fill($request->all());
            $model->save();
            
            DB::commit();
            return redirect()->back()->with('success', 'បានបញ្ចូល');
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    
  
    public function edit($id)
    {
        $item = Vehicle::find($id);
        return view('settings.vehicles.edit', [
            'item' => $item,
        ]);
    }
    
    public function update(VehicleRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $model = Vehicle::findOrFail($id);
            $model->fill($request->all());
            $model->save();
            
            DB::commit();
            return redirect()->back()->with('success', 'បានកែប្រែ');
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {            
            Vehicle::findOrFail($id)->delete();
            DB::commit(); 
            return redirect()->back()->with('success', 'ជោគជ័យ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }  
    } 
}
