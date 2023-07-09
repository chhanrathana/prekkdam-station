<?php

namespace App\Http\Controllers\Reports\Operations;

use App\Enums\DownloadEnum;
use App\Exports\ReportOperationSaleExport;
use App\Http\Controllers\Controller;
use App\Http\Services\Settings\DownloadService;
use App\Models\OilSale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SaleDailyController extends Controller
{
    public function index(Request $request)
    {   
        if(!$request->date){
            $request->date = Carbon::now()->format('d/m/Y');
        }     
        
        return view('reports.operations.sales-daily.index',[
            'records'=> $this->getSales($request),
            'shifts' => $this->getWorkShifts(),
            'date'  => $request->date,
        ]);
    }

    public function download(Request $request, $type)
    {
        $records = $this->getSales($request);

        if($type == DownloadEnum::PDF){
            $html = view('reports.operations.sales-daily.pdf',[
                'records' =>$records,
                'date' => $request->date,
            ]);
            return DownloadService::PDF($html, $title = 'របាការណ៍', $orientation = 'L', $font = 12, $printCard = false, $mt = 2, $ml = 2, $mr = 2, $format = 'A5');
        }
        return Excel::download(new ReportOperationSaleExport($records, $request->from_date, $request->to_date), 'sale_transaction.xlsx');
    }

    private function getSales($request){
        $query = OilSale::select('oil_sales.*');
                        
        $query->when($request->date, function ($q) use ($request) {            
            $q->where('oil_sales.date', '=', formatToOrignDate($request->date));
        });

        $query->when($request->work_shift_id && $request->work_shift_id <> 'all', function ($q) use ($request) {            
            $q->where('oil_sales.work_shift_id', '=', $request->work_shift_id);
        });
    
        $query->orderBy('oil_sales.work_shift_id');
        return $query->get();
    }
    private function groupBy (){
        $query = OilSale::query();
        $query->select(
            DB::raw('date(expense_datetime) as expense_date'), 
            DB::raw('sum(amount) as total_amount')
        );
        $query->where('branch_id',$brandId);
        $query->whereDate('expense_datetime', '>=', $fromDate);
        $query->whereDate('expense_datetime', '<=', $toDate);   
        $query->groupBy('expense_date');
        $query->orderBy('expense_date','desc');
        $expenses = $query->get();        
    }
}
