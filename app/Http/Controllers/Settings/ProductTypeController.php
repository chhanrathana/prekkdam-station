<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ProductTypeRequest;
use App\Models\Settings\ProductType;
use Illuminate\Support\Facades\DB;

class ProductTypeController extends Controller
{
    
    public function index()
    {
        $items = ProductType::all();
        return view('settings.product-types.index', [
            'items' => $items
        ]);
    }
   
    public function create()
    {
        return view('settings.product-types.create');
    }
  
    public function store(ProductTypeRequest $request)
    {       

        DB::beginTransaction();
        try {            
            $model = new ProductType();
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
        $item = ProductType::find($id);
        return view('settings.product-types.edit', [
            'item' => $item
        ]);
    }
    
    public function update(ProductTypeRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $model = ProductType::findOrFail($id);
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
            ProductType::findOrFail($id)->delete();
            DB::commit(); 
            return redirect()->back()->with('success', 'ជោគជ័យ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }  
    } 
}