<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\VendorRequest;
use App\Models\MasterData\Vendor;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    
    public function index()
    {        
        $items = Vendor::all();        
        return view('master-data.vendors.index', [
            'items' => $items
        ]);
    }
   
    public function create()
    {
        return view('master-data.vendors.create', [
            'code' => $this->generateVendorCode(),
            'sexes' => $this->getSexes(),
        ]);
    }
  
    public function store(VendorRequest $request)
    {       
        DB::beginTransaction();
        try {            
            $input = $request->all();            
            $model = new Vendor();
            $model->fill($input);
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
        $item = Vendor::find($id);
        return view('master-data.vendors.edit', [
            'item' => $item,           
            'sexes' => $this->getSexes(),           
        ]);
    }
    
    public function update(VendorRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $model = Vendor::findOrFail($id);
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
            Vendor::findOrFail($id)->delete();
            DB::commit(); 
            return redirect()->back()->with('success', 'ជោគជ័យ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }  
    } 
}
