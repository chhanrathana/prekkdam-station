<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonthlyReportExport implements FromView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view() : View
    {
        return view('exports.operation-reports.loans.index', [
            'loans' => $this->data
        ]);
    }
}
