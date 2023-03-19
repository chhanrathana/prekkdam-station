<?php

namespace App\Models\MasterData;

use App\Models\BaseModel;
use App\Models\ProductMgts\ProductOrder;

class File extends BaseModel
{
    protected $table = 'files';    

    protected $fillable = ['id', 'file','remark'];

    public function productOrders(){        
        return $this->belongsToMany(ProductOrder::class,'product_order_files');
    }
}
