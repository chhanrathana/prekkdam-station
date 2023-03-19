<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Commune;
use App\Models\MasterData\District;
use App\Models\MasterData\Village;

class AddressController extends Controller
{
    public function index($type, $id){
        $type = strtolower(trim($type));
        if ($type == 'district' || $type == 'pob_district' ) {
            return District::where([
                ['province_id', $id]
            ])->get();
        }elseif($type == 'commune' || $type == 'pob_commune'){
            return Commune::where([
                ['district_id', $id]
            ])->get();
        }
        return Village::where([
                ['commune_id', $id]
        ])->get();
    }   
}
