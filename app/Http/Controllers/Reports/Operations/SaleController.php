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
            'records' => $this->getSales($request)
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
        $query = OilSale::query();
        
        $query->when($request->code, function ($q) use ($request) {
            $code = mb_strtoupper(trim($request->code));
            $q->where('code', $code);
        });

        $query->when($request->name, function ($q) use ($request) {
            $name = mb_strtoupper(trim($request->name));
            $q->where('name_kh', 'like', '%' . $name . '%');
            $q->orWhere('name_en', 'like', '%' . $name . '%');
        });
        $query->orderByDesc('date');
        return $query->get();
    }
}
