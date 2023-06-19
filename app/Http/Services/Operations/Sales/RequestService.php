<?php

namespace App\Http\Services\Operations\Sales;

use App\Models\OilPurchase;
use App\Models\OilSale;

class RequestService
{
   
    public function createSale($request)
    {
        $oilPurchase = OilPurchase::where('id', $request->oil_purchase_id)->first();

        $record = OilSale::find($request->oil_purchase_id);
        if (!$record) {
            $record = new OilSale();
            $record->code = generateOilSaleCode();
        }
        $record->fill($request->only([
            'sale_date', 'oil_purchase_id', 'work_shift_id', 'old_capacitor_r', 'new_capacitor_r', 'old_capacitor_l', 'new_capacitor_l','sale_price_khr'
        ]));
        $record->qty_liter_r = $request->new_capacitor_r - $request->old_capacitor_r;
        $record->qty_liter_l = $request->new_capacitor_l - $request->old_capacitor_l;
        $record->total_qty_liter = $record->qty_liter_r + $request->qty_liter_l;
        $record->total_qty_ton = $record->total_qty_liter / getLiterOfTon($oilPurchase->oil_type_id);
        $record->sale_price_usd = $request->sale_price_khr / getExchangeRate($request->sale_date);
        $record->total_sale_price_khr = $record->total_qty_liter * $request->sale_price_khr;
        $record->total_sale_price_usd = $record->total_sale_price_khr / getExchangeRate($request->sale_date);
        $record->save();
        return $record;
    }

    public function getSales($request, $paginate = true)
    {
        $query = OilSale::query();              
        $query->orderByDesc('code');        
        if ($paginate) {
            return $query->paginate(env('PAGINATION'));
        }
        return $query->get();
    }    
}