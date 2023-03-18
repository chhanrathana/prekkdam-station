<?php
namespace App\Services\Api\Telegrams;

use Carbon\Carbon;
use App\Models\Payment\TotalTransaction;
use App\Enums\PaymentStatusEnum;


class TelegramService
{
    
	
    /// -1001193154698 MPWT OSSP Tracking Channcel
    private function sendMessage($msg)
    {
        $env = env('APP_ENV');
        if($env == 'LIVE'){
            $chatId = env('TELEGRAM_MPWT_OSS_TRACKING_CHANNEL_LIVE');
        }
        elseif ($env == 'UAT') {
            $chatId = env('TELEGRAM_MPWT_OSS_TRACKING_CHANNEL_UAT');
        }else{
            $chatId = env('TELEGRAM_MPWT_OSS_TRACKING_CHANNEL_DEV');
        }
        
        
        $token = env('TELEGRAM_MPWT_AUTOMATION_SYSTEM_BOT');
        $curl = curl_init();
        $msg = urlencode(trim($msg));
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.telegram.org/bot$token/sendMessage?chat_id=$chatId&text=$msg&parse_mode=markdown",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        return $response;
    }

    public function sendPaymentNotification($partner, $referenceNumber, $type, $resCode, $amount, $start, $end){
        
        $today = Carbon::now()->format('Y-m-d');
        
        $caption = '';
        
        if($resCode == 200){
            $tranaction = TotalTransaction::where([
                ['pg_code', $partner],
                ['transaction_date', $today],
                ['transaction_status', PaymentStatusEnum::SUCCESS]
            ])->first();
            if (!$tranaction) {
                $tranaction = new TotalTransaction();
                $tranaction->transaction_status = PaymentStatusEnum::SUCCESS;
                $tranaction->transaction_date = $today;
                $tranaction->pg_code = $partner;
            }            
            if($type == 'REVERSE'){
                $tranaction->total_transaction =  $tranaction->total_transaction - 1;
                $tranaction->total_amount = $tranaction->total_amount - $amount;
            }else{
                $tranaction->total_transaction =  $tranaction->total_transaction + 1;
                $tranaction->total_amount =  $tranaction->total_amount + $amount;
            }
            $tranaction->save();

            $status =  'Success';
            $emoju = '✅' ;
            $caption =  number_format($tranaction->total_transaction).' TXN|'.number_format($tranaction->total_amount).' KHR';
        }else{
            $tranaction = TotalTransaction::where([
                ['pg_code', $partner],
                ['transaction_date', $today],
                ['transaction_status', PaymentStatusEnum::FAILE]
            ])->first();
            if (!$tranaction) {
                $tranaction = new TotalTransaction();
                $tranaction->transaction_status = PaymentStatusEnum::FAILE;
                $tranaction->transaction_date = $today;
                $tranaction->pg_code = $partner;
            }                
            $tranaction->total_transaction = $tranaction->total_transaction + 1;
            $tranaction->save();
            
            $status =  'Fail::' . $resCode;
            $emoju =  '⚠️';
            $caption = number_format($tranaction->total_transaction).' TXN';
        }
        

        $start = Carbon::parse($start);
        $end = Carbon::parse($end);
        $seconds = $start->diffInSeconds($end);

        $now = Carbon::now()->format('d/m/Y H:i:s');
        if($amount > 0){
            $amount = number_format($amount);
        }
        $env = env('APP_ENV');
        $text = "";
        // $text = "`$now`\n";
        $text .= "`$emoju"."OSSP PAYMENT TRACKING($env)[$type] `\n\n";
        $text .= "`$today|$caption`\n\n";

        $text .= "`PG     :$partner`\n";
        $text .= "`Ref    :$referenceNumber`\n";
        $text .= "`Amount :$amount KHR`\n";
        $text .= "`Status :$status`\n\n";
        $text .= "`➡️     :$start`\n";
        $text .= "`⬅️     :$end`\n";        
        $text .= "`⏱     :$seconds s`\n";        
        $this->sendMessage($text);
    }

    public function sendInternalErrorNotification($partner, $referenceNumber, $type, $message){                        
        $now = Carbon::now()->format('d/m/Y H:i:s');
        $env = env('APP_ENV');
        $text = "";
        $text .= "`⛔️FOSSP PAYMENT TRACKING($env) [$type]`\n\n";        
        $text .= "`PG     :$partner`\n";
        $text .= "`Ref    :$referenceNumber`\n";
        $text .= "`MSG    :$message`\n"; 
            
        $this->sendMessage($text);
    }
}
