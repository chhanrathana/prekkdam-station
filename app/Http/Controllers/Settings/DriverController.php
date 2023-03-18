<?php

namespace App\Http\Controllers\Settings;

use App\Enums\ShareHolderTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\DriverRequest;
use App\Models\Settings\ShareHolder;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    
    public function index()
    {        
        $items = ShareHolder::where('shareholder_type_id', ShareHolderTypeEnum::DRIVER)
        ->orderBy('created_at','desc')
        ->get();
        
        return view('settings.drivers.index', [
            'items' => $items
        ]);
    }
   
    public function create()
    {
        return view('settings.drivers.create', [
            'code' => $this->generateDriverCode(),
            'provinces' => $this->getProvinces(),
            'sexes' => $this->getSexes(),
        ]);
    }
  
    public function store(DriverRequest $request)
    {       

        DB::beginTransaction();
        try {            
            $input = $request->all();
            $input['shareholder_type_id'] = ShareHolderTypeEnum::DRIVER;
            $model = new ShareHolder();
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
        $item = ShareHolder::find($id);
        return view('settings.drivers.edit', [
            'item' => $item,
            'provinces' => $this->getProvinces(),
            'sexes' => $this->getSexes(),
            'districts' => $this->getDistrictsByProvince($item->province_id),
            'communes' => $this->getCommuneByDistrict($item->district_id),
            'villages' => $this->getVillageByCommune($item->commune_id),            
        ]);
    }
    
    public function update(DriverRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $model = ShareHolder::findOrFail($id);
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
            ShareHolder::findOrFail($id)->delete();
            DB::commit(); 
            return redirect()->back()->with('success', 'ជោគជ័យ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }  
    } 
}