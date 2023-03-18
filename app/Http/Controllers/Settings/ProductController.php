<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ProductRequest;
use App\Models\Settings\Product;
use App\Models\Settings\ProductType;
use App\Models\Settings\SaleType;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    public function index()
    {
        $items = Product::all();
        return view('settings.products.index', [
            'items' => $items
        ]);
    }
   
    public function create()
    {
        return view('settings.products.create',[
            'productTypes' => ProductType::all(),
            'saleTypes' => SaleType::all(),
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
            
            $model->saleTypes()->sync($request->sale_type_id);
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
        return view('settings.products.edit', [            
            'item' => $item,
            'saleTypes' => SaleType::all(),
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

            $model->saleTypes()->sync($request->sale_type_id);
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