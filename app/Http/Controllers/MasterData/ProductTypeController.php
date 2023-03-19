<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\ProductTypeRequest;
use App\Http\Requests\Settings\ProductRequest;
use App\Models\MasterData\Product;
use App\Models\MasterData\ProductType;
use App\Models\MasterData\SaleType;
use App\Services\MasterData\ProductTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTypeController extends Controller
{   
    protected $service;

    public function __construct()
    {
       $this->service = new ProductTypeService();
    }

    public function index(Request $request)
    {
        return view('master-data.product-types.index', [
            'items' => $this->service->getAll($request)
        ]);
    }
   
    public function create()
    {
        return view('master-data.product-types.create');
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
        return view('master-data.product-types.edit', [            
            'item' => ProductType::find($id),            
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
            Product::findOrFail($id)->delete();
            DB::commit(); 
            return redirect()->back()->with('success', 'ជោគជ័យ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }  
    } 
}