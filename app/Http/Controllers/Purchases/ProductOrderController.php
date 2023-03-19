<?php

namespace App\Http\Controllers\PurchaseMgts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ProductOrderRequest;
use App\Models\ProductMgts\ProductOrder;
use App\Models\MasterData\Product;
use Illuminate\Support\Facades\DB;

class ProductOrderController extends Controller
{
    
    public function index()
    {
        $items = ProductOrder::all();
        return view('purchase-mgts.product-orders.index', [
            'items' => $items
        ]);
    }
   
    public function create()
    {
        return view('purchase-mgts.product-orders.create',[
            'products' => $this->getProducts(),
            'branches' => $this->getBranches(),
            'drivers' => $this->getDrivers(),
            'vendors' => $this->getVendors(),
            'vehicles' => $this->getVehicles(),            
        ]);
    }
  
    public function store(ProductOrderRequest $request)
    {               
        DB::beginTransaction();
        try {            
            $input = $request->all();               
            $input['remain_qty'] = $input['qty'];
            $input['total_cost'] = $input['unit_cost'] *  $input['qty'];
            $order = new ProductOrder();
            $order->fill($input);
            $order->save();
            DB::commit();
            return redirect()->back()->with('success', 'បានបញ្ចូល');
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
      
    public function edit($id)
    {
        $item = ProductOrder::find($id);
        return view('purchase-mgts.product-orders.edit', [            
            'item' => $item,
            'products' => $this->getProducts(),
            'branches' => $this->getBranches(),
            'drivers' => $this->getDrivers(),
            'vendors' => $this->getVendors(),
            'vehicles' => $this->getVehicles(),
        ]);
    }
    
    public function update(ProductOrderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $input = $request->all();               
            $input['remain_qty'] = $input['qty'];
            $input['total_cost'] = $input['unit_cost'] *  $input['qty'];
            $order = ProductOrder::findOrFail($id);
            $order->fill($input);        
            $order->save();
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


    private function storeStep01($request){
        $order = new ProductOrder();
        $order->fill($request->all());
        $order->save();        
    }
}