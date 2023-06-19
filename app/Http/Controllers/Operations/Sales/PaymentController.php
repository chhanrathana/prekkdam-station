<?php

namespace App\Http\Controllers\Operations\Sales;

use Illuminate\Http\Request;
use App\Models\LoanPayment;
use App\Enums\LoanTypeEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Requests\LoanPaymentRequest;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $paymeneDate = $request->end_interest_date?? Carbon::now()->format(env('CLOSING_DATE'));   
        $records = $this->loanPaymentSevice->getPayments($request, $paymeneDate);

        return view('operations.loans.payments.index', [
            'paymeneDate' => $paymeneDate,
            'records' => $records,
        ]);
    }

    public function edit($id)
    {
        $record = LoanPayment::find($id);
        return view('operations.loans.payments.edit', [
            'record' => $record,
        ]);
    }

    public function update(LoanPaymentRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $record = LoanPayment::where('id', $id)->first();
            $loan = Loan::find($record->loan->id);
            
            // handle befor process
            if ($record->status == PaymentStatusEnum::PAID) {
                return redirect()->back()->with('error', __('message.paid'));
            }

            switch ($loan->loan_type_id) {
                case LoanTypeEnum::FLEXIBLE:

                    if ($request->interest_paid_amount > $record->interest_pending_amount) {
                        return redirect()->back()->with('error', __('message.interest_bigger'));
                    }
        
                    if ($request->deduct_paid_amount > $record->balance_amount) {
                        return redirect()->back()->with('error', __('message.deduct_bigger'));
                    }

                    $this->loanPaymentSevice->updateFlexiblePayment($request, $id);
                  break;
                
                case LoanTypeEnum::FIX:

                    if ($request->interest_paid_amount <> $record->interest_pending_amount) {
                        return redirect()->back()->with('error', __('message.interest_not_match'));
                    }
    
                    if ($request->deduct_paid_amount <> $record->deduct_pending_amount) {
                        return redirect()->back()->with('error', __('message.deduct_not_match'));
                    }
                    
                    $this->loanPaymentSevice->updateFixPayment($request, $id);
                  break;

                default:
                    return redirect()->back()->with('error', __('message.failed'));
              }
                       
            DB::commit();
            return redirect()->route('operation.loan.payment.index');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }       
    } 
}