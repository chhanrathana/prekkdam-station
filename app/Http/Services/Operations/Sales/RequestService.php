<?php

namespace App\Http\Services\Operations\Sales;

use App\Enums\CurrencyEnum;
use App\Enums\OilStatusEnum;
use App\Enums\UnitEnum;
use App\Models\OilPurchase;
use App\Models\OilSale;

class RequestService
{
   
    public function createSale($request)
    {
        $oilPurchase = OilPurchase::where('id', $request->oil_purchase_id)->first();

        $record = OilSale::find($request->oil_sale_id);
        if (!$record) {
            $record = new OilSale();
            $record->code = generateOilSaleCode();
        }
        $record->fill($request->only([
            'date', 'oil_purchase_id', 'work_shift_id', 'old_motor_right', 'new_motor_right', 'old_motor_left', 'new_motor_left','price'
        ]));            
        $record->exchange_rate = getExchangeRate(formatToOrignDate($request->date));        
        $record->cost = ($oilPurchase->cost * $oilPurchase->exchange_rate / ($oilPurchase->qty * $oilPurchase->type->liter_of_ton)) ;
        $record->currency = CurrencyEnum::KHR;
        $record->unit = UnitEnum::LITERS;
        $record->save();

        $useQty = OilSale::where('oil_purchase_id', $request->oil_purchase_id)->sum('qty');
        // update remain qty
        $oilPurchase->remain_qty = $oilPurchase->qty -  ($useQty / $oilPurchase->type->liter_of_ton);
        if($oilPurchase->remain_qty <= 0){
            $oilPurchase->status_id = OilStatusEnum::OUT_STOCK;
        }
        $oilPurchase->save();
        return $record;
    }

    public function getSales($request, $paginate = true)
    {
        $query = OilSale::query();      
        
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