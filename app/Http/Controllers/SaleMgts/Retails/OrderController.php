<?php

namespace App\Http\Controllers\SaleMgts\Retails;

use App\Enums\RetailSaleStatusEnum;
use App\Enums\SaleTypeEnum;
use App\Enums\WholesaleStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleMgts\AddProductRequest;
use App\Http\Requests\SaleMgts\RetailSaleRequest;
use App\Http\Requests\SaleMgts\WholesaleRequest;
use App\Models\SaleMgts\RetailSale;
use App\Models\SaleMgts\RetailSaleProduct;
use App\Models\SaleMgts\Wholesale;
use App\Models\SaleMgts\WholesaleProduct;
use App\Traits\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    
    public function index()
    {
        $items = RetailSale::all();
        return view('sale-mgts.retails.orders.index', [
            'items' => $items
        ]);
    }
   
    public function create(Request $request)
    {        
        $item = RetailSale::find($request->id);

        return view('sale-mgts.retails.orders.create',[
            'item' => $item,
            'code' => $this->getRetailSaleCode(),
            'clients' => $this->getClients(),
            'drivers' => $this->getDrivers(),
            'vehicles' => $this->getVehicles(),
            'products' => $this->getSaleProducts(SaleTypeEnum::RETAILSALE),
        ]);
    }
   
      
    public function store(RetailSaleRequest $request, $id = null)
    {       
        
        DB::beginTransaction();
        try {           
            $input = $request->all();
            $retail = RetailSale::find($id);
            if(!$retail){
                $retail = new RetailSale();
            }
            $input['total_amount'] = $retail->products->sum('total_price');
            $input['status_id'] = RetailSaleStatusEnum::NEW_ORDER;
            $retail->fill($input);
            $retail->save();
            DB::commit();
            return redirect()->route('sale-mgts.retail.order.create',['id' => $retail->id??'']);                                                                                
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function editProduct($id, $productId)
    {
        $item = RetailSale::find($id);
        $_product = RetailSaleProduct::find($productId);
        
        return view('sale-mgts.retails.orders.create',[            
            'item' => $item,
            '_product' => $_product,            
            'clients' => $this->getClients(),
            'branches' => $this->getBranches(),
            'drivers' => $this->getDrivers(),
            'vehicles' => $this->getVehicles(),
            'products' => $this->getSaleProducts(SaleTypeEnum::RETAILSALE),
        ]);
    }

    public function storeProduct(AddProductRequest $request, $id = null)
    {   DB::beginTransaction();
        try {

            $input = $request->all();
            $input['total_price'] = $input['unit_price'] *  $input['qty'];
            $product = RetailSaleProduct::find($id);
            if(!$product){
                $product = new RetailSaleProduct();
            }
            $product->fill($input);
            $product->save();
            
            $retail = RetailSale::find($product->retail_sale_id);
            $retail->total_amount = $retail->products->sum('total_price');
            $retail->save();
            DB::commit();
            return redirect()->route('sale-mgts.retail.order.create',[
                'id' => $product->retail_sale_id,
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
            RetailSale::findOrFail($id)->delete();
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
        $html = view('sale-mgts.retails.orders.print',[
            'item' => Wholesale::find($id),
        ]);  
        return PDF::output($html);
    }
}