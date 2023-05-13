   
<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-clock"></i>
        <strong>{{ __('form.payment_schedule') }}</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>                            
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>                 
                        <th class="text-center text-nowrap">{{ __('form.status') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.transaction_date') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.end_interest_date') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.principal_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.deduct_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.deduct_pending_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.deduct_paid_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.interest_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.interest_pending_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.interest_paid_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.loan_add_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.balance_amount') }}</th>   
                    </tr>
                </thead>
                <tbody>
                    @foreach ($record->payments as $payment)
                    <tr> 
                        <td class="text-center text-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="text-center text-nowrap"><span class="{{ $payment->_status->css }}">{{ $payment->_status->name }}</span></td>
                        <td class="text-center text-nowrap">{{ $payment->transaction_datetime}}</td>
                        <td class="text-center text-nowrap">{{ $payment->start_interest_date .' - '.$payment->end_interest_date}}</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->principal_amount,2) }} KHR</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->deduct_amount, 2)}} KHR</td>  
                        <td class="text-right text-nowrap">{{ number_format($payment->deduct_pending_amount, 2)}} KHR</td>  
                        <td class="text-right text-nowrap text-success">{{ number_format($payment->deduct_paid_amount, 2)}} KHR</td>  
                        <td class="text-right text-nowrap">{{ number_format($payment->interest_amount,2)}} KHR</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->interest_pending_amount,2)}} KHR</td>
                        <td class="text-right text-nowrap text-success">{{ number_format($payment->interest_paid_amount,2)}} KHR</td>
                        <td class="text-right text-nowrap text-danger">{{ number_format($payment->loan_amount,2)}} KHR</td>
                        <td class="text-right text-nowrap text-bold">{{ number_format($payment->balance_amount) }} KHR</td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>          
    </div>
</div>