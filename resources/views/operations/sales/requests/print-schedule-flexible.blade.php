@extends('layouts.pdf-layout')

@section('html')
    
    @include('operations.loans.requests.print-header')
    
    <div class="report" id="report">             
        <table class="th-color">
            <tr>                
                <th style="width: 45px;" rowspan="2">{{ __('form.no') }}</th>
                <th style="width: 70px;" rowspan="2">{{ __('form.end_interest_date') }}</th>                
                <th style="width: 90px;" rowspan="2">{{ __('form.principal_amount') }}</th>

                <th style="width: 90px;" colspan="2">{{ __('form.paid_amount') }}</th>                
                <th style="width: 90px;" rowspan="2">{{ __('form.loan_amount') }}</th>
                <th style="width: 90px;" rowspan="2">{{ __('form.commision_amount') }}</th>
                <th style="width: 90px;" rowspan="2">{{ __('form.balance_amount') }}</th>
                <th style="width: 200px;"colspan="2">{{ __('form.sign') }}</th>
            </tr>
            <tr>                
                <th style="width: 90px;">{{ __('form.interest_amount') }}</th>
                <th style="width: 90px;">{{ __('form.deduct_amount') }}</th>

                <th style="width: 100px;">{{ __('form.borrower') }}</th>
                <th style="width: 100px;">{{ __('form.casheir') }}</th>
            </tr>
            @php
                $lastIn = 0;
            @endphp
            @foreach ($record->payments as $payment)                
                <tr>                    
                    <td class="text-center text-nowrap" style="height: 35px">{{ ++$lastIn }}</td>
                    <td class="text-left" nowrap="nowrap">{{ $payment->transaction_datetime }}</td>
                    <td class="text-right text-nowrap">{{ number_format($payment->principal_amount) }}</td>
                    <td class="text-right text-nowrap">{{ number_format($payment->interest_paid_amount) }}</td>
                    <td class="text-right text-nowrap">{{ number_format($payment->deduct_paid_amount) }} </td>
                    <td class="text-right" >{{ number_format($payment->loan_amount) }} </td>
                    <td class="text-right text-nowrap">{{ number_format($payment->loan->commission_amount) }} </td>
                    <td class="text-right" >{{ number_format($payment->balance_amount) }} </td>
                    <td class="text-right text-nowrap"></td>
                    <td class="text-right text-nowrap"></td>
                </tr>
            @endforeach
            
            @for ($i = 1; $i < (22 - $lastIn); $i++)
            <tr>
                <td class="text-center text-nowrap" style="height: 35px">{{ $lastIn + $i }}</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            @endfor
        </table>
    </div>

    @include('operations.loans.requests.print-footer')
@stop