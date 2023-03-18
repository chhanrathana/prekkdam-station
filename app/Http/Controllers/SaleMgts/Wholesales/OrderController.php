<?php

namespace App\Http\Controllers\SaleMgts\Wholesales;

use App\Enums\SaleTypeEnum;
use App\Enums\WholesaleStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleMgts\AddProductRequest;
use App\Http\Requests\SaleMgts\WholesaleRequest;
use App\Models\SaleMgts\Wholesale;
use App\Models\SaleMgts\WholesaleProduct;
use App\Traits\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    
    public function index()
    {
        $items = Wholesale::all();
        return view('sale-mgts.wholesales.orders.index', [
            'items' => $items
        ]);
    }
   
    public function create(Request $request)
    {        
        $item = Wholesale::find($request->id);

        return view('sale-mgts.wholesales.orders.create',[
            'item' => $item,
            'code' => $this->getWholesaleCode(),
            'clients' => $this->getClients(),
            'branches' => $this->getBranches(),
            'drivers' => $this->getDrivers(),
            'vehicles' => $this->getVehicles(),
            'products' => $this->getSaleProducts(SaleTypeEnum::WHOLESALE),
        ]);
    }
   
      
    public function store(WholesaleRequest $request, $id = null)
    {       
        
        DB::beginTransaction();
        try {           
            $input = $request->all();
            $wholesale = Wholesale::find($id);
            if(!$wholesale){
                $wholesale = new Wholesale();
            }
            $input['total_amount'] = $wholesale->products->sum('total_price');
            $input['status_id'] = WholesaleStatusEnum::NEW_ORDER;
            $wholesale->fill($input);
            $wholesale->save();
            DB::commit();
            return redirect()->route('sale-mgts.wholesale.order.create',['id' => $wholesale->id??'']);                                                                                
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function editProduct($id, $productId)
    {
        $item = Wholesale::find($id);
        $_product = WholesaleProduct::find($productId);
        
        return view('sale-mgts.wholesales.orders.create',[            
            'item' => $item,
            '_product' => $_product,            
            'clients' => $this->getClients(),
            'branches' => $this->getBranches(),
            'drivers' => $this->getDrivers(),
            'vehicles' => $this->getVehicles(),
            'products' => $this->getSaleProducts(SaleTypeEnum::WHOLESALE),
        ]);
    }

    public function storeProduct(AddProductRequest $request, $id = null)
    {   DB::beginTransaction();
        try {

            $input = $request->all();
            $input['total_price'] = $input['unit_price'] *  $input['qty'];
            $product = WholesaleProduct::find($id);
            if(!$product){
                $product = new WholesaleProduct();
            }
            $product->fill($input);
            $product->save();
            
            $wholesale = Wholesale::find($product->wholesale_id);
            $wholesale->total_amount = $wholesale->products->sum('total_price');
            $wholesale->save();
            DB::commit();
            return redirect()->route('sale-mgts.wholesale.order.create',[
                'id' => $product->wholesale_id,
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {            
            Wholesale::findOrFail($id)->delete();
            DB::commit(); 
            return redirect()->back()->with('success', 'ជោគជ័យ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }  
    }

    
    public function destroyProduct($id)
    {
        DB::beginTransaction();
        try {            
            WholesaleProduct::findOrFail($id)->delete();
            DB::commit(); 
            return redirect()->back()->with('success', 'ជោគជ័យ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }  
    }

    public function print($id){        
        $html = view('sale-mgts.wholesales.orders.print',[
            'item' => Wholesale::find($id),
        ]);  
        return PDF::output($html);
    }
}