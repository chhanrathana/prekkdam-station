<?php

namespace App\Http\Controllers\Reports\Purchases;

use App\Enums\DownloadEnum;
use App\Exports\ReportOperationSaleExport;
use App\Http\Controllers\Controller;
use App\Http\Services\Settings\DownloadService;
use App\Models\OilPurchase;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MonthlyController extends Controller
{
    public function index(Request $request)
    {        
        return view('reports.purchases.monthly.index',[
            'records'=> $this->getPurchases($request),
            'types'  => $this->getOilTypes(),
        ]);
    }

    public function download(Request $request, $type)
    {
        $records = $this->getPurchases($request);

        if($type == DownloadEnum::PDF){
            $html = view('reports.purchases.monthly.pdf',[
                'records' =>$records,
                'fromDate' => $request->from_date,
                'toDate' => $request->to_date,
            ]);
            return DownloadService::PDF($html, $title = 'របាការណ៍', $orientation = 'P', $font = 12, $printCard = false, $mt = 4, $ml = 4, $mr = 4);
        }

        return Excel::download(new ReportOperationSaleExport($records, $request->from_date, $request->to_date), 'sale_transaction.xlsx');
    }

    private function getPurchases($request){
        $query = OilPurchase::select('oil_purchases.*');
        
        $query->when($request->oil_type_id && $request->oil_type_id <> 'all', function ($q) use ($request) {
            $oilTypeId = mb_strtoupper(trim($request->oil_type_id));
            // $q->join('oil_purchases', 'oil_sales.oil_purchase_id', 'oil_purchases.id');
            $q->where('oil_purchases.oil_type_id', $oilTypeId);
            $q->whereNull('oil_purchases.deleted_at');
        });
        
        $query->when($request->from_date, function ($q) use ($request) {
            $q->where('oil_purchases.date', '>=', formatToOrignDate($request->from_date));
        });

        $query->when($request->to_date, function ($q) use ($request) {
            $q->where('oil_purchases.date', '<=', formatToOrignDate($request->to_date));
        });
        

        $query->orderByDesc('oil_purchases.date');
        return $query->get();
    }
}
