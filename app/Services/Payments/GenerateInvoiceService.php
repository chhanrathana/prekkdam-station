<?php
namespace App\Services\Payments;

use App\Models\Invoices\InvoiceTestCase;
use App\Services\ApiService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GenerateInvoiceService extends ApiService
{
 
    public function getInvoices($versionId, $batch, $url, $auth, $form){
        $res = $this->post($url, $auth, $form);

        $data = isset($res['data'])?$res['data']:null;
        if(count($data) > 0){
            $insert = [];
            foreach ($data as $item) {                      
                $insert[] = [
                   'id' => (string)Str::uuid(),
                   'batch' => $batch,
                   'reference_number' => $item['reference_number'],
                   'amount' => $item['amount'],
                   'customer_name' => $item['customer_name'],
                   'system_version_id' => $versionId,
                   'created_at' => Carbon::now(),
                   'updated_at' => Carbon::now(),
               ];
           }
           InvoiceTestCase::insert($insert);
        }

        return InvoiceTestCase::where('batch', $batch)->get();
    }
}
