<?php

namespace App\Http\Controllers\Settings;

use App\Models\District;
use App\Models\Commune;
use App\Models\Village;

class AddressController extends Controller
{
    public function index($type, $id){
        if (ucfirst($type) == "District") {
            return District::where([
                ['province_id', $id]
            ])->get();
        }elseif(ucfirst($type) == "Commune"){
            return Commune::where([
                ['district_id', $id]
            ])->get();
        }
        return Village::where([
                ['commune_id', $id]
        ])->get();
    }
}
