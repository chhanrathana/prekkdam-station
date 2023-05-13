<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-list"></i>
        <strong>{{ __('form.loan_payment_list') }}</strong>  
    </div>
    <div class="card-body">                
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap"></th>
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.loan_code') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.type') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.client_code') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.client') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.end_interest_date') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.principal_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.deduct_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.interest_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.balance_amount') }}</th>                                            
                    </tr>
                </thead>
                <tbody>
                  
                    @php
                        $totalBalanceAmount = 0;
                        $totalInterestAmount = 0;
                        $totalDeductAmount = 0;
                        $totalPrincipalAmount = 0;
                        $i = 1;
                    @endphp
                    @foreach ($records as $record)
                        @php                            
                            $totalDeductAmount += $record->deduct_pending_amount;
                            $totalInterestAmount += $record->interest_pending_amount;
                            $totalPrincipalAmount += $record->loan->principal_amount;
                            $totalBalanceAmount += $record->loan->balance_amount;
                        @endphp
                        <tr>                            
                            <td class="text-center text-nowrap">   
                                <div class="btn-group" role="group" aria-label="Action">                                    
                                    <a class="btn btn-sm btn-danger" href="{{ route('operation.loan.payment.edit',['id' => $record->id ])}}" type="button">
                                        <i class="fas fa-pen"></i> {{ __('form.btn_paid') }}
                                    </a>
                                </div>
                            </td>      
                            <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                            <td class="text-center text-nowrap">{{ $record->loan->code??''}}</td>
                            <td class="text-center text-nowrap">{{ $record->loan->type->name??''}}</td>
                            <td class="text-center text-nowrap">{{ $record->loan->client->code??''}}</td>
                            <td class="text-left text-nowrap">{{ $record->loan->client->name_kh??''}}</td>
                            <td class="text-center text-nowrap">{{ $record->end_interest_date??''}}</td>
                            <td class="text-right text-nowrap">{{ number_format($record->loan->principal_amount??0,2)}} KHR</td>
                            <td class="text-right text-nowrap">{{ number_format($record->deduct_pending_amount??0,2) }} KHR</td>
                            <td class="text-right text-nowrap text-success">{{ number_format($record->interest_pending_amount??0,2) }} KHR</td>
                            <td class="text-right text-nowrap text-bold">{{ number_format($record->loan->balance_amount??0,2) }} KHR</td>                            
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-right" colspan="7"><strong>{{ __('form.total') }}</strong></td>
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount,2) }} KHR</td>
                        <td class="text-right text-nowrap">{{ number_format($totalDeductAmount,2) }} KHR</td>
                        <td class="text-right text-nowrap text-success">{{ number_format($totalInterestAmount,2) }} KHR</td>
                        <td class="text-right text-nowrap text-bold">{{ number_format($totalBalanceAmount,2) }} KHR</td>
                    </tr>
                </tbody>
            </table>
        </div>        
    </div>
</div>