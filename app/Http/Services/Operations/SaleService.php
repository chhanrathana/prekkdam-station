<?php

namespace App\Http\Services\Operations;

use App\Enums\CurrencyEnum;
use App\Enums\OilStatusEnum;
use App\Enums\UnitEnum;
use App\Models\OilPurchase;
use App\Models\OilSale;

class SaleService
{
   
    public function createSale($request, $oilPurchase)
    {        
        $record = OilSale::find($request->oil_sale_id);
        if (!$record) {
            $record = new OilSale();
            $record->code = generateOilSaleCode();
        }
        $record->fill($request->only([
            'date', 
            'oil_purchase_id', 
            'work_shift_id', 
            'old_motor_right', 
            'new_motor_right', 
            'old_motor_left', 
            'new_motor_left',
            'price',
            'staff_id',
            'client_id',
            'paid_amount',
            'tank_id'
        ]));            
        $record->exchange_rate = getExchangeRate(formatToOrignDate($request->date));        
        $record->cost = $oilPurchase->cost;
        $record->currency = CurrencyEnum::KHR;
        $record->unit = UnitEnum::LITERS;
        $record->save();

        $useQty = $record->qty + ($record->sales->sum('qty'));
        // update remain qty
        $remainQty = ($oilPurchase->qty -  $useQty);
        if($remainQty <= 0){
            $oilPurchase->status_id = OilStatusEnum::OUT_STOCK;

            // release new stock for sale
            $releaseNewStock = OilPurchase::where('oil_type_id', $oilPurchase->oil_type_id)
            ->where('status_id', OilStatusEnum::POSTPONSE)
            ->orderBy('date')
            ->first();
            if($releaseNewStock){
                $releaseNewStock->status_id = OilStatusEnum::ON_SALE;
                $releaseNewStock->save();
            }
        }
        $oilPurchase->save();
        return $record;
    }

    public function getSales($request, $paginate = true)
    {
        $query = OilSale::query();      
        
        $query->when($request->oil_type_id && $request->oil_type_id <> 'all', function ($q) use ($request) {
            $oilTypeId = mb_strtoupper(trim($request->oil_type_id));
            $q->join('oil_purchases', 'oil_sales.oil_purchase_id', 'oil_purchases.id');
            $q->where('oil_purchases.oil_type_id', $oilTypeId);
            $q->whereNull('oil_purchases.deleted_at');
        });

        // $query->when($request->oil_type_id, function ($q) use ($request) {
        //     oil_purchases
        //     $q->where('oil_type_id', $request->oil_type_id);
        // });

        $query->when($request->from_date, function ($q) use ($request) {
            $q->where('oil_sales.date', '>=', formatToOrignDate($request->from_date));
        });

        $query->when($request->to_date, function ($q) use ($request) {
            $q->where('oil_sales.date', '<=', formatToOrignDate($request->to_date));
        });
        
        $query->orderByDesc('oil_sales.code');        
        if ($paginate) {
            return $query->paginate(env('PAGINATION'));
        }
        return $query->get(['oil_sales.*']);
    }    
}