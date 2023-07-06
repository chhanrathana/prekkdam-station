<?php

namespace App\Http\Controllers\Reports\Operations;

use App\Enums\DownloadEnum;
use App\Http\Controllers\Controller;
use App\Http\Services\Settings\DownloadService;
use App\Models\OilSale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {        
        return view('reports.operations.sales.index',[
            'records'=> $this->getSales($request),
            'types'  => $this->getOilTypes(),
        ]);
    }

    public function download(Request $request, $type)
    {
        
        if($type == DownloadEnum::PDF){
            $html = view('reports.operations.sales.pdf',[
                'records' => $this->getSales($request),
                'fromDate' => $request->from_date,
                'toDate' => $request->to_date,
            ]);
            return DownloadService::PDF($html, $title = 'របាការណ៍', $orientation = 'L', $font = 12, $printCard = false, $mt = 2, $ml = 2, $mr = 2);
        }

        $records = OilSale::all();
        return view('reports.operations.sales.index',[
            'records' => $records
        ]);
    }

    private function getSales($request){
        $query = OilSale::select('oil_sales.*');
        
        $query->when($request->oil_type_id, function ($q) use ($request) {
            $oilTypeId = mb_strtoupper(trim($request->oil_type_id));
            $q->join('oil_purchases', 'oil_sales.oil_purchase_id', 'oil_purchases.id');
            $q->where('oil_purchases.oil_type_id', $oilTypeId);
        });

        $query->when($request->code, function ($q) use ($request) {
            $code = mb_strtoupper(trim($request->code));
            $q->where('code', $code);
        });

        $query->when($request->from_date, function ($q) use ($request) {
            $q->where('date', '>=', formatToOrignDate($request->from_date));
        });

        $query->when($request->to_date, function ($q) use ($request) {
            $q->where('date', '<=', formatToOrignDate($request->to_date));
        });
        

        $query->orderByDesc('date');
        return $query->get();
    }
}
