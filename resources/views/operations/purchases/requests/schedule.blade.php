   
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
                    @foreach ($record->payments as $record)
                    <tr> 
                        <td class="text-center text-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="text-center text-nowrap"><span class="{{ $record->_status->css }}">{{ $record->_status->name_kh }}</span></td>
                        <td class="text-center text-nowrap">{{ $record->transaction_datetime}}</td>
                        <td class="text-center text-nowrap">{{ $record->start_interest_date .' - '.$record->end_interest_date}}</td>
                        <td class="text-right text-nowrap">{{ number_format($record->principal_amount) }}</td>
                        <td class="text-right text-nowrap">{{ number_format($record->deduct_amount)}}</td>  
                        <td class="text-right text-nowrap">{{ number_format($record->deduct_pending_amount)}}</td>  
                        <td class="text-right text-nowrap text-success">{{ number_format($record->deduct_paid_amount)}}</td>  
                        <td class="text-right text-nowrap">{{ number_format($record->interest_amount)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($record->interest_pending_amount)}}</td>
                        <td class="text-right text-nowrap text-success">{{ number_format($record->interest_paid_amount)}}</td>
                        <td class="text-right text-nowrap text-danger">{{ number_format($record->loan_amount)}}</td>
                        <td class="text-right text-nowrap text-bold">{{ number_format($record->balance_amount) }}</td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>          
    </div>
</div>