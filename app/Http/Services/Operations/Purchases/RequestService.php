<?php

namespace App\Http\Services\Operations\Purchases;

use App\Enums\CurrencyEnum;
use App\Enums\UnitEnum;
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
            'date', 'status_id', 'oil_type_id', 'qty', 'cost'
        ]));
        $record->remain_qty = $record->qty;
        $record->exchange_rate = getExchangeRate(formatToOrignDate($request->date));
        $record->currency = CurrencyEnum::USD;
        $record->unit = UnitEnum::TONS;
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