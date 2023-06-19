@extends('layouts.pdf-layout')

@section('html')
    @include('operations.loans.requests.print-header')
    
    <div class="report" id="report">             
        <table class="th-color">
            <tr>                
                <th style="width: 45px;" rowspan="2">{{ __('form.no') }}</th>
                <th style="width: 70px;" rowspan="2">{{ __('form.end_interest_date') }}</th>
                <th style="width: 90px;" rowspan="2">{{ __('form.principal_amount') }}</th>
                <th style="width: 90px;" rowspan="2">{{ __('form.deduct_amount') }}</th>
                <th style="width: 90px;" rowspan="2">{{ __('form.interest_amount') }}</th>
                <th style="width: 90px;" rowspan="2">{{ __('form.balance_amount') }}</th>
                <th style="width: 200px;" colspan="2">{{ __('form.sign') }}</th>
            </tr>
            <tr>
                <th style="width: 100px;">{{ __('form.borrower') }}</th>
                <th style="width: 100px;">{{ __('form.casheir') }}</th>
            </tr>

            @foreach ($record->payments as $payment)                
                <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td class="text-left" nowrap="nowrap">{{ $payment->end_interest_date }}</td>
                    <td class="text-right">{{ number_format($payment->principal_amount) }}</td>                
                    <td class="text-right">{{ number_format($payment->deduct_amount) }} </td>
                    <td class="text-right" >{{ number_format($payment->interest_amount) }} </td>
                    <td class="text-right">{{ number_format($payment->balance_amount) }} </td>                    
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                </tr>
            @endforeach
        </table>
    </div>
    @include('operations.loans.requests.print-footer')
@stop