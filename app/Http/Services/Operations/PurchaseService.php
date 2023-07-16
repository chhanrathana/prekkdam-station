<?php

namespace App\Http\Services\Operations;

use App\Enums\CurrencyEnum;
use App\Enums\UnitEnum;
use App\Models\OilPurchase;

class PurchaseService
{
   
    public function createPurchase($request)
    {
        $record = OilPurchase::find($request->oil_purchase_id);
        if (!$record) {
            $record = new OilPurchase();
            $record->code = generateOilPurchaseCode();
        }
        $record->fill($request->only([
            'date', 
            'status_id', 
            'oil_type_id', 
            'qty', 
            'cost', 
            'vendor_id',
            'paid_amount',
            // 'tank_id'
        ]));        
        $record->exchange_rate = getExchangeRate(formatToOrignDate($request->date));
        $record->currency = CurrencyEnum::KHR;
        $record->unit = UnitEnum::LITERS;
        $record->save();
        return $record;
    }

    public function getPurchases($request, $paginate = true)
    {
        $query = OilPurchase::query();       
        
        $query->when($request->oil_type_id, function ($q) use ($request) {
            $q->where('oil_type_id', $request->oil_type_id);
        });

        $query->when($request->from_date, function ($q) use ($request) {
            $q->where('date', '>=', formatToOrignDate($request->from_date));
        });

        $query->when($request->to_date, function ($q) use ($request) {
            $q->where('date', '<=', formatToOrignDate($request->to_date));
        });

        $query->orderByDesc('code');        
        if ($paginate) {
            return $query->paginate(env('PAGINATION'));
        }
        return $query->get();
    }    
}