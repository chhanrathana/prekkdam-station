<?php

namespace App\Http\Controllers\SaleMgts\Stations;

use App\Enums\SaleTypeEnum;
use App\Enums\StationStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleMgts\AddProductRequest;
use App\Http\Requests\SaleMgts\StationSaleRequest;
use App\Models\SaleMgts\StationSaleProduct;
use App\Models\SaleMgts\StationSale;
use App\Traits\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    
    public function index()
    {
        $items = StationSale::all();
        return view('sale-mgts.stations.orders.index', [
            'items' => $items
        ]);
    }
   
    public function create(Request $request)
    {        
        $item = StationSale::find($request->id);

        return view('sale-mgts.stations.orders.create',[
            'item' => $item,
            'code' => $this->getStationSaleCode(),
            'staffs' => $this->getStaffs(),            
            'turns' => $this->getTurns(),
            'products' => $this->getSaleProducts(SaleTypeEnum::STATIONSALE),
        ]);
    }
         
    public function store(StationSaleRequest $request, $id = null)
    {       
        
        DB::beginTransaction();
        try {           
            $input = $request->all();
            $station = StationSale::find($id);
            if(!$station){
                $station = new StationSale();
            }
            $input['total_amount'] = $station->products->sum('total_price');
            $input['paid_amount'] = $input['total_amount'];
            $input['status_id'] = StationStatusEnum::FINISH_PAYMENT;
            $station->fill($input);
            $station->save();
            DB::commit();
            return redirect()->route('sale-mgts.station.order.create',['id' => $station->id??'']);                                                                                
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function editProduct($id, $productId)
    {
        $item = StationSale::find($id);
        $_product = StationSaleProduct::find($productId);
        
        return view('sale-mgts.stations.orders.create',[            
            'item' => $item,
            '_product' => $_product,            
            'staffs' => $this->getStaffs(),            
            'turns' => $this->getTurns(),
            'products' => $this->getSaleProducts(SaleTypeEnum::STATIONSALE),
        ]);
    }

    public function storeProduct(AddProductRequest $request, $id = null)
    {   
        DB::beginTransaction();
        try {
            $input = $request->all();

            if(!$request->station_sale_id){
                $station = new StationSale();
                $station->fill($input);
                $station->save();
                $input['station_sale_id'] = $station->id;
            }
            
            $input['total_price'] = $input['unit_price'] *  $input['qty'];
            $product = StationSaleProduct::find($id);
            if(!$product){
                $product = new StationSaleProduct();
            }
            $product->fill($input);
            $product->save();
            
            $station = StationSale::find($product->station_sale_id);
            $station->total_amount = $station->products->sum('total_price');
            $station->paid_amount = $station->total_amount;
            $station->status_id = StationStatusEnum::FINISH_PAYMENT;
            $station->save();
            DB::commit();
            return redirect()->route('sale-mgts.station.order.create',[
                'id' => $product->station_sale_id,
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
            StationSale::findOrFail($id)->delete();
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
            StationSaleProduct::findOrFail($id)->delete();
            DB::commit(); 
            return redirect()->back()->with('success', 'ជោគជ័យ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }  
    }

    public function print($id){        
        $html = view('sale-mgts.stations.orders.print',[
            'item' => StationSale::find($id),
        ]);  
        return PDF::output($html);
    }
}