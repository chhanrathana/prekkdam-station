<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use App\Models\OilType;
use Illuminate\Http\Request;

class OilTypeController extends Controller
{
    public function index(Request $request)
    {                
        $records = OilType::orderBy('id')->get();
        return view('dashboards.oil-types.index',[
            'records' => $records,
        ]);
    }
}
