<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InterestReportExport implements FromView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exports.financial-reports.revenue-interests.summary-list', [
            'payments' => $this->data,
        ]);
    }
}
