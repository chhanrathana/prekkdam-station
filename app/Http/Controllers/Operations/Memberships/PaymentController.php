<?php

namespace App\Http\Controllers\Operations\Memberships;

use App\Enums\DepositTypeEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepositPaymentRequest;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Deposit;
use App\Models\DepositPayment;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $paymeneDate = $request->end_interest_date?? Carbon::now()->format(env('CLOSING_DATE'));   
        $records = $this->depositPaymentService->getPayments($request, $paymeneDate);
        
        return view('operations.memberships.payments.index', [
            'paymeneDate' => $paymeneDate,
            'records' => $records,
        ]);
    }

    public function edit($id)
    {
        $record = DepositPayment::find($id);

        return view('operations.memberships.payments.edit', [
            'record' => $record,
        ]);
    }

    public function update(DepositPaymentRequest $request, $id)
    {        
        DB::beginTransaction();
        try {

            $payment = DepositPayment::where('id', $id)->first();
            $deposit = Deposit::find($payment->deposit->id);

            // handle befor process
            if ($payment->status == PaymentStatusEnum::PAID) {
                return redirect()->back()->with('error', __('message.paid'));
            }

            if ($request->withdraw_amount > $payment->balance_amount) {
                return redirect()->back()->with('error', __('message.withdraw_bigger'));
            }

            if($deposit->deposit_type_id == DepositTypeEnum::DEPOSIT){
                
            }

            switch ($deposit->deposit_type_id) {
                case DepositTypeEnum::DEPOSIT:

                    if ($request->withdraw_amount > 0 && $request->withdraw_amount <> $payment->balance_amount) {
                        return redirect()->back()->with('error', __('message.withdraw_not_match_balance'));
                    }   

                    $this->depositPaymentService->updateDepositPayment($request, $id);
                  break;
                
                case DepositTypeEnum::SAVING:                    
                    $this->depositPaymentService->updateSavingPayment($request, $id);
                  break;

                default:
                    return redirect()->back()->with('error', __('message.failed'));
              }
            
            DB::commit();
            return redirect()->route('operation.membership.payment.index');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }       
    } 
}