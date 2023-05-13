@extends('layouts.pdf-layout')

@section('html')
    <div class="text-center heading-title-center khmer-moul"><h4>កាលវិភាគសងប្រាក់</h4></div>
    <br>
    <br>
    <div class="row">
        <table style="width: 100%; font-size:12px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>{{ __('form.client_code') }}</td>
                <td>{{$record->client->code}}</td>                
                <td>{{ __('form.loan_code') }}</td>
                <td>{{$record->code}}</td> 
            </tr>
            <tr>                                           
                <td >{{ __('form.client') }}</td>
                <td>{{$record->client->name_kh}}</td>        
                <td>លេខទូរសព្ទ</td>
                <td>{{$record->client->phone_number}}</td>        
            </tr>
            <tr>
                <td>អាសយដ្ឋាន</td>
                <td>{{$record->client->address}}</td>                
            </tr>
            <tr>                
                <td>{{ __('form.principal_amount') }}</td>
                <td>{{ number_format($record->principal_amount, 2) }} KHR</td>
                <td>ការប្រាក់</td>
                <td>{{ number_format($record->interest_rate, 2)}} %</td>
            </tr>
            <tr>
                <td>{{ __('form.registration_date') }}</td>
                <td>{{$record->registration_date}}</td>

                <td>{{ __('form.term') }}</td>
                <td>{{$record->term}} </td>
            </tr>           
        </table>
    </div>
    
    <div class="text-right">
        <small class="print-date"><i>printed at {{ \Carbon\Carbon::now() }}</i></small>   
    </div>
    <div class="report" id="report">             
        <table class="th-color">
            <tr>                
                <th style="width: 45px;" rowspan="2">{{ __('form.no') }}</th>
                <th style="width: 70px;" rowspan="2">{{ __('form.end_interest_date') }}</th>
                <th style="width: 120px;" rowspan="2">{{ __('form.principal_amount') }}</th>
                <th style="width: 120px;" rowspan="2">{{ __('form.deduct_amount') }}</th>
                <th style="width: 120px;" rowspan="2">{{ __('form.interest_amount') }}</th>
                <th style="width: 120px;" rowspan="2">{{ __('form.balance_amount') }}</th>
                <th style="width: 150px;" colspan="2">ហត្តលេខា</th>
            </tr>
            <tr>
                <th style="width: 75px;">អ្នកខ្ចី</th>                
                <th style="width: 75px;">បេឡា</th>
            </tr>

            @foreach ($record->payments as $payment)                
                <tr>
                    <td class="text-center text-nowrap" style="height: 35px">{{ $loop->index + 1 }}</td>
                    <td class="text-left" nowrap="nowrap">{{ $payment->end_interest_date }}</td>
                    <td class="text-right text-nowrap">{{ number_format($payment->principal_amount, 2) }}</td>                
                    <td class="text-right text-nowrap">{{ number_format($payment->deduct_amount, 2) }} </td>
                    <td class="text-right" >{{ number_format($payment->interest_amount, 2) }} </td>
                    <td class="text-right text-nowrap">{{ number_format($payment->balance_amount, 2) }} </td>                    
                    <td class="text-right text-nowrap"></td>
                    <td class="text-right text-nowrap"></td>
                </tr>
            @endforeach
        </table>
    </div>

    <table style="width:100%; line-height: 3; border: 0px solid rgba(255, 255, 255, 0) !important;">
        <tr style="border: 0px solid rgba(255, 255, 255, 0) !important;">
            <th style="text-align:center; border: 0px solid rgba(255, 255, 255, 0) !important;">
                <div class="caption-left">
                <div class="text-center">
                    <br>
                    <div class="text-left">
                        <p class="p">ក្រសោមសត្វ ថ្ងៃ............. ខែ............. ឆ្នាំ {{ \Carbon\Carbon::now()->format('Y') }}</p>
                    </div>
                    <div class="khmer-moul" style="pandding-left:20px;">បេឡាសមាគមន៏ </div>
                    <br>
                    <div class="text-left">
                        <div style="margin-left:100px;" >
                            ឈ្មោះ :...............................
                        </div>
                    </div>
                </div>
                </div>
            </th>

            <th style="width: 250px; border: 0px solid rgba(255, 255, 255, 0) !important;">

            </th>

            <th style="text-align: center; border: 0px solid rgba(255, 255, 255, 0) !important;">
                <div class="caption-right">
                    <div class="text-right">
                    <br>
                        <div class="text-left">
                            <p class="p">ក្រសោមសត្វ ថ្ងៃ............. ខែ............. ឆ្នាំ {{ \Carbon\Carbon::now()->format('Y') }}</p>
                        </div>
                        <div class="khmer-moul" style="pandding-left:20px;">ស្នាមមេដៃអ្នកខ្ចី</div>
                        <br>
                        <div class="text-right">
                            <div style="margin-left:100px;" >
                                ឈ្មោះ :...............................
                            </div>
                        </div>
                    </div>
                </div>
            </th>
        </tr>
    </table>    
@stop