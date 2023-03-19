<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\ProductRequest;
use App\Models\MasterData\Product;
use App\Models\MasterData\ProductType;
use App\Models\MasterData\SaleType;
use App\Models\MasterData\Unit;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    public function index()
    {
        $items = Product::all();
        return view('master-data.products.index', [
            'items' => $items
        ]);
    }
   
    public function create()
    {
        return view('master-data.products.create',[
            'productTypes' => ProductType::all(),
            'units' => Unit::all(),
            'code' => $this->generateProductCode()
        ]);
    }
  
    public function store(ProductRequest $request)
    {       
        DB::beginTransaction();
        try {            
            $model = new Product();
            $model->fill($request->all());
            $model->save();
            
            // $model->saleTypes()->sync($request->sale_type_id);
            DB::commit();
            return redirect()->back()->with('success', 'បានបញ្ចូល');
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
      
    public function edit($id)
    {
        $item = Product::find($id);
        return view('master-data.products.edit', [            
            'item' => $item,
            'units' => Unit::all(),
            'productTypes' => ProductType::all(),
        ]);
    }
    
    public function update(ProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $model = Product::findOrFail($id);
            $model->fill($request->all());            
            $model->save();

            // $model->saleTypes()->sync($request->sale_type_id);
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
            Product::findOrFail($id)->delete();
            DB::commit(); 
            return redirect()->back()->with('success', 'ជោគជ័យ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }  
    } 
}