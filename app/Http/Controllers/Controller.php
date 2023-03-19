<?php

namespace App\Http\Controllers;

use App\Models\MasterData\Customer;
use App\Models\MasterData\Product;
use App\Models\MasterData\Sex;
use App\Models\MasterData\Vendor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function generateProductCode()
    {
        $digits = 4;
        $subfix = str_pad(Product::withTrashed()->count() + 1, $digits, '0', STR_PAD_LEFT);
        return 'P' . $subfix;
    }

    protected function getWholesaleCode()
    {
        $digits = 4;
        $subfix = str_pad(Wholesale::withTrashed()->count() + 1, $digits, '0', STR_PAD_LEFT);
        return 'WS' . $subfix;
    }

    protected function getRetailSaleCode()
    {
        $digits = 4;
        $subfix = str_pad(RetailSale::withTrashed()->count() + 1, $digits, '0', STR_PAD_LEFT);
        return 'RS' . $subfix;
    }
    
    protected function getStationSaleCode()
    {
        $digits = 4;
        $subfix = str_pad(StationSale::withTrashed()->count() + 1, $digits, '0', STR_PAD_LEFT);
        return 'SS' . $subfix;
    }

    protected function generateCustomerCode()
    {
        $digits = 4;        
        $subfix = str_pad(Customer::withTrashed()->count() + 1, $digits, '0', STR_PAD_LEFT);
        return 'C' . $subfix;
    }

    protected function generateVendorCode()
    {
        $digits = 4;
        $subfix = str_pad(Vendor::withTrashed()->count() + 1, $digits, '0', STR_PAD_LEFT);
        return 'V' . $subfix;
    }

    protected function generateDriverCode()
    {
        $digits = 4;
        $subfix = str_pad(ShareHolder::where('shareholder_type_id', ShareHolderTypeEnum::DRIVER)->withTrashed()->count() + 1, $digits, '0', STR_PAD_LEFT);
        return 'D' . $subfix;
    }

    protected function storeFile($path, $remark = ''){
        $file = new File();
        $file->file = $path;
        $file->remark = $remark;
        $file->save();
        return $file->id;
    }

    protected function getVehicles(){
        return Vehicle::all();
    }
    
    protected function getTurns(){
        return Turn::all();
    }

    protected function getSaleProducts($saleCode){
        return Product::whereHas('saleTypes', function($query) use($saleCode){
            $query->where('code', $saleCode);
        })->get();
    }

    protected function getProducts(){
        return Product::all();
    }

    protected function getBranches(){
        return Branch::all();
    }

    protected function getClients(){
        return ShareHolder::where('shareholder_type_id', ShareHolderTypeEnum::CLIENT)->get();
    }

    protected function getDrivers(){
        return ShareHolder::where('shareholder_type_id', ShareHolderTypeEnum::DRIVER)->get();
    }

    protected function getVendors(){
        return ShareHolder::where('shareholder_type_id', ShareHolderTypeEnum::VENDOR)->get();
    }

    protected function getStaffs(){
        return ShareHolder::where('shareholder_type_id', ShareHolderTypeEnum::STAFF)->get();
    }

    protected function getProvinces(){
        return Province::all();
    }

    protected function getSexes(){
        return Sex::all();
    }

    protected function getDistrictsByProvince($provinceId){
        return District::where('province_id', $provinceId)->get();
    }

    protected function getCommuneByDistrict($districtId){
        return Commune::where('district_id', $districtId)->get();
    }

    protected function getVillageByCommune($communeId){
        return Village::where('commune_id', $communeId)->get();
    }
}
