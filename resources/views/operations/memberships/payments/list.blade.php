<div class="card">
    <div class="card-header text-white bg-info">    
        <i class="fas fa-list"></i>
        <strong>{{ __('form.membership_payment_list') }}</strong>  
    </div>
    <div class="card-body">                
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap"></th>
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.deposit_code') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.client_code') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.client') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.end_interest_date') }}</th>                        
                        <th class="text-center text-nowrap">{{ __('form.principal_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.interest_amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.balance_amount') }}</th>                                            
                    </tr>
                </thead>
                <tbody>
                  
                    @php
                        $totalBalanceAmount = 0;
                        $totalInterestAmount = 0;
                        $totalPrincipalAmount = 0;
                        $i = 1;
                    @endphp
                    @foreach ($records as $record)
                        @php
                            $totalBalanceAmount += $record->balance_amount;
                            $totalInterestAmount += $record->interest_amount;
                            $totalPrincipalAmount += $record->principal_amount;
                        @endphp
                        <tr>                            
                            <td class="text-center text-nowrap">   
                                <div class="btn-group" role="group" aria-label="Action">                                    
                                    <a class="btn btn-sm btn-danger" href="{{ route('operation.membership.payment.edit',['id' => $record->id ])}}" type="button">
                                        <i class="fas fa-pen"></i> {{ __('form.btn_paid') }}
                                    </a>
                                </div>
                            </td>      
                            <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                            <td class="text-center text-nowrap">{{ $record->deposit->code??''}}</td>
                            <td class="text-left text-nowrap">{{ $record->deposit->client->code??''}}</td>
                            <td class="text-left text-nowrap">{{ $record->deposit->client->name_kh??''}}</td>
                            <td class="text-center text-nowrap">{{ $record->end_interest_date}}</td>
                            <td class="text-right text-nowrap">{{ number_format(($record->principal_amount)) }} KHR</td>
                            <td class="text-right text-nowrap">{{ number_format($record->interest_amount)}} KHR</td>
                            <td class="text-right text-nowrap">{{ number_format($record->balance_amount) }} KHR</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-right" colspan="6"><strong>{{ __('form.total') }}</strong></td>                        
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                        <td class="text-right text-nowrap">{{ number_format($totalInterestAmount) }} KHR</td>                        
                        <td class="text-right text-nowrap">{{ number_format($totalBalanceAmount) }} KHR</td>                        
                    </tr>
                </tbody>
            </table>
        </div>        
    </div>
</div>