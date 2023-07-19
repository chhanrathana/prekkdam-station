<?php

namespace App\Http\Controllers\Reports\Purchases;

use App\Enums\DownloadEnum;
use App\Exports\ReportOperationSaleExport;
use App\Http\Controllers\Controller;
use App\Http\Services\Settings\DownloadService;
use App\Models\OilPurchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DailyController extends Controller
{
    public function index(Request $request)
    {   
        if(!$request->date){
            $request->date = Carbon::now()->format('d/m/Y');
        }     
        
        return view('reports.purchases.daily.index',[
            'records'=> $this->getPurchases($request),            
            'date'  => $request->date,
        ]);
    }

    public function download(Request $request, $type)
    {
        $records = $this->getPurchases($request);

        if($type == DownloadEnum::PDF){
            $html = view('reports.purchases.daily.pdf',[
                'records' =>$records,
                'date' => $request->date,
            ]);
            return DownloadService::PDF($html, $title = 'របាការណ៍', $orientation = 'L', $font = 12, $printCard = false, $mt = 2, $ml = 2, $mr = 2, $format = 'A5');
        }
        return Excel::download(new ReportOperationSaleExport($records, $request->from_date, $request->to_date), 'sale_transaction.xlsx');
    }

    private function getPurchases($request){
        $query = OilPurchase::select('oil_purchases.*');                        
        $query->when($request->date, function ($q) use ($request) {            
            $q->where('oil_purchases.date', '=', formatToOrignDate($request->date));
        });

        $query->orderBy('oil_purchases.oil_type_id');
        return $query->get();
    }   
}
