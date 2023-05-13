<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LoanPayment;
use App\Models\PaymentTransaction;

class PaymentSeeder extends Seeder
{
  
    public function run()
    {
       // loan
       $payments = getBackupData('payments');        
       $this->storePayment($payments);

    //    $trxs = getBackupData('payment_transactions');  
    //    $this->storePaymentTransactions($trxs);
        // $this->generatePaymentTransactions();
    }

     private function storePayment($payments){        
        $data = [];        
        foreach ($payments as $item) {        
               $data[] = [
                'id' => $item['id'],                
                'start_end_interest_date' => $item['start_end_interest_date'],
                'end_interest_date' => $item['end_interest_date'],
                'last_payment_paid_date' => $item['last_payment_paid_date'],
                'sort' => $item['sort'],
                'deduct_amount' => $item['deduct_amount'],
                'deduct_paid_amount' => $item['deduct_paid_amount'],
                'interval' => $item['interval'],
                'interest_amount' => $item['interest_amount'],
                // 'commission_amount' => $item['commission_amount'],
                'total_amount' => $item['total_amount'],
                'total_paid_amount' => $item['total_paid_amount'],
                // 'penalty_amount' => $item['penalty_amount'],
                'pending_amount' => $item['pending_amount'],
                // 'cross_amount' => $item['cross_amount'],
                'remark' => $item['remark'],
                'loan_id' => $item['loan_id'],
                'status' => $item['status'],                
                
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'deleted_at' => $item['deleted_at'],
            ];          
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
          LoanPayment::insert($chunk);
        }
    }  
    
    private function generatePaymentTransactions(){
        $payments = LoanPayment::where('status', 'finish')->get();
        foreach($payments as $payment){
            paymentTransaction($payment, $payment->total_paid_amount, $type = 'deduction');
        }

        $payments = LoanPayment::whereIn('status', ['paid', 'lack'])->get();
        foreach($payments as $payment){
            paymentTransaction($payment, $payment->total_paid_amount, $type = 'interest');
        }
    }

    private function storePaymentTransactions($trxs){
        $data = [];        
        
        foreach ($trxs as $item) {
               $data[] = [
                'id' => $item['id'],                
                'transaction_datetime' => $item['transaction_datetime'],
                'transaction_amount' => $item['transaction_amount'],
                'deduct_amount' => $item['deduct_amount'],
                'interest_amount' => $item['interest_amount'],
                'commission_amount' => $item['commission_amount'],
                'revenue_amount' => $item['revenue_amount'],
                'setlement_datetime' => $item['setlement_datetime'],                
                'type' => $item['type'],
                'payment_id' => $item['payment_id'],
                 
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'deleted_at' => $item['deleted_at'],
            ];          
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
          PaymentTransaction::insert($chunk);
        }
    } 
}