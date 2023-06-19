<?php

namespace App\Http\Services\Operations\Purchases;

use App\Models\OilPurchase;

class RequestService
{
   
    public function createPurchase($request)
    {
        $record = OilPurchase::find($request->oil_purchase_id);
        if (!$record) {
            $record = new OilPurchase();
            $record->code = generateOilPurchaseCode();
        }
        $record->fill($request->only([
            'purchase_date', 'status_id', 'oil_type_id', 'qty_ton', 'cost_usd'
        ]));
        $record->qty_liter = $request->qty_ton * getLiterOfTon($request->oil_type_id);
        $record->cost_khr = $request->cost_usd * getExchangeRate($request->purchase_date);
        $record->total_cost_usd = $record->cost_usd * $request->qty_ton;
        $record->total_cost_khr = $record->cost_khr * $request->qty_ton;
        $record->pending_qty_ton = $record->qty_ton;
        $record->pending_qty_liter = $record->qty_liter;
        $record->save();
        return $record;
    }

    public function getPurchases($request, $paginate = true)
    {
        $query = OilPurchase::query();              
        $query->orderByDesc('code');        
        if ($paginate) {
            return $query->paginate(env('PAGINATION'));
        }
        return $query->get();
    }    
}