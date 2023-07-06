<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportOperationSaleExport implements FromView
{
    protected $records;
    protected $fromDate;
    protected $toDate;

    public function __construct($records, $fromDate, $toDate)
    {
        $this->records = $records;        
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function view(): View
    {
        return view('reports.operations.sales.excel', [
            'records' => $this->records,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
        ]);
    }
}
