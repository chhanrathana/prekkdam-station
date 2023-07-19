<?php

namespace App\Http\Controllers\Reports\Accountings;

use App\Enums\DownloadEnum;
use App\Http\Controllers\Controller;
use App\Http\Services\Settings\DownloadService;
use App\Models\OilSale;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportOperationSaleExport;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        return view('reports.accountings.revenues.index',[
            'records'=> $this->getSales($request),
        ]);
    }

    public function download(Request $request, $type)
    {
        $records = $this->getSales($request);

        if($type == DownloadEnum::PDF){
            $html = view('reports.accountings.revenues.pdf',[
                'records' =>$records,
                'fromDate' => $request->from_date,
                'toDate' => $request->to_date,
            ]);
            return DownloadService::PDF($html, $title = 'របាការណ៍', $orientation = 'P', $font = 12, $printCard = false, $mt = 2, $ml = 2, $mr = 2, $format = 'A5');
        }
        return Excel::download(new ReportOperationSaleExport($records, $request->from_date, $request->to_date), 'sale_transaction.xlsx');
    }

    private function getSales($request){
        $query = OilSale::select('oil_sales.*');
        
        $query->when($request->oil_type_id && $request->oil_type_id <> 'all', function ($q) use ($request) {
            $oilTypeId = mb_strtoupper(trim($request->oil_type_id));
            $q->join('oil_purchases', 'oil_sales.oil_purchase_id', 'oil_purchases.id');
            $q->where('oil_purchases.oil_type_id', $oilTypeId);
            $q->whereNull('oil_purchases.deleted_at');
        });
        
        $query->when($request->from_date, function ($q) use ($request) {
            $q->where('oil_sales.date', '>=', formatToOrignDate($request->from_date));
        });

        $query->when($request->to_date, function ($q) use ($request) {
            $q->where('oil_sales.date', '<=', formatToOrignDate($request->to_date));
        });
        

        $query->orderByDesc('oil_sales.date');
        return $query->get();
    }
}
