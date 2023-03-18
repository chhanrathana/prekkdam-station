<?php
namespace App\Services\Payments;

use App\Models\Invoices\InvoiceTestCase;
use App\Models\Invoices\InvoiceTestCasePayment;
use App\Services\ApiService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TestInvoiceService extends ApiService
{
 
    public function lookup($url, $auth, $form, $request){
        $data = $this->get($url, $auth, $form);
        if(count($data) > 0){
            if($data['response_code'] == 200){
                $invoice = InvoiceTestCasePayment::where('reference_number', $data['reference_number'])->first();
                if(!$invoice){
                     $invoice = new InvoiceTestCasePayment();
                }
                $invoice->reference_number = $data['reference_number'];
                $invoice->customer_name = $data['customer_name'];
                $invoice->amount = $data['amount'];
                $invoice->session_id = $data['session_id'];
                $invoice->payment_gateway_id = $request->payment_gateway_id;
                $invoice->api_version_id = $request->api_version_id;
                $invoice->status = 'LOOKUP';
                $invoice->save();
                return $invoice;
            }
            return $data['response_msg'];
        }
        return 'មិនអាចភ្ជាប់ការបង់ប្រាក់បាន';
    }

    public function commit($url, $auth, $form){
        $data = $this->post($url, $auth, $form);
        
        if(count($data) > 0){
            if($data['response_code'] == 200){
                $invoice = InvoiceTestCasePayment::where('reference_number', $data['reference_number'])->first();                
                $invoice->transaction_id = $data['transaction_id'];
                $invoice->partner = $form['partner'];                                
                $invoice->status = 'PAID';
                $invoice->save();
                return $invoice;
            }
            return $data['response_msg'];
        }
        return 'មិនអាចភ្ជាប់ការបង់ប្រាក់បាន';
    }

    public function reverse($url, $auth, $form){
        $data = $this->post($url, $auth, $form);
        if(count($data) > 0){
            if($data['response_code'] == 200){
                $invoice = InvoiceTestCasePayment::where('reference_number', $data['reference_number'])->first();                
                $invoice->reversal_transaction_id = $data['reversal_transaction_id'];                
                $invoice->status = 'REVERSE';
                $invoice->save();
                return $invoice;
            }
            return $data['response_msg'];
        }
        return 'មិនអាចភ្ជាប់ការបង់ប្រាក់បាន';
    }
}
