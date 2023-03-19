<?php
namespace App\Services\MasterData;

use App\Models\MasterData\ProductType;

class ProductTypeService 
{
 
  public function getAll($request){
    return ProductType::all();
  }
}
