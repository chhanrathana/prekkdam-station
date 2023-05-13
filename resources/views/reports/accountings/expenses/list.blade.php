<div class="card">
    <div class="card-header text-white bg-info">    
        <i class="fas fa-list"></i>
        <strong>{{ __('form.accounting_expense_list') }}</strong>  
    </div>
    <div class="card-body">                
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap"></th>
                        <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.date') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.type') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.amount') }}</th>
                        <th class="text-center text-nowrap">{{ __('form.description') }}</th>                                                                       
                    </tr>
                </thead>
                <tbody>
                  
                    @php
                        $totalBalanceAmount = 0;
                        $totalInterestAmount = 0;
                        $totalPrincipalAmount = 0;
                        $i = 1;
                    @endphp
                    {{-- @foreach ($payments as $payment)
                        @php
                            $totalBalanceAmount += $payment->balance_amount;
                            $totalInterestAmount += $payment->interest_amount;
                            $totalPrincipalAmount += $payment->principal_amount;
                        @endphp
                        <tr>                            
                            <td class="text-center text-nowrap">   
                                <div class="btn-group" role="group" aria-label="Action">                                    
                                    <a class="btn btn-sm btn-danger" href="{{ route('operation.deposit.payment.edit',['id' => $payment->id ])}}" type="button">
                                        <i class="fas fa-pen"></i> {{ __('form.btn_paid') }}
                                    </a>
                                </div>
                            </td>      
                            <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                            <td class="text-center text-nowrap">{{ $payment->deposit->code??''}}</td>
                            <td class="text-left text-nowrap">{{ $payment->deposit->client->code??''}}</td>
                            <td class="text-left text-nowrap">{{ $payment->deposit->client->name_kh??''}}</td>
                            <td class="text-center text-nowrap">{{ $payment->end_interest_date}}</td>
                            <td class="text-right text-nowrap">{{ number_format(($payment->principal_amount)) }} KHR</td>
                            <td class="text-right text-nowrap">{{ number_format($payment->interest_amount)}} KHR</td>
                            <td class="text-right text-nowrap">{{ number_format($payment->balance_amount) }} KHR</td>
                        </tr>
                    @endforeach --}}
                    <tr>
                        <td class="text-right" colspan="4"><strong>{{ __('form.total') }}</strong></td>                        
                        <td class="text-right text-nowrap">{{ number_format($totalPrincipalAmount) }} KHR</td>
                        <td></td>
                        {{-- <td class="text-right text-nowrap">{{ number_format($totalInterestAmount) }} KHR</td>                        
                        <td class="text-right text-nowrap">{{ number_format($totalBalanceAmount) }} KHR</td>                         --}}
                    </tr>
                </tbody>
            </table>
        </div>        
    </div>
</div>