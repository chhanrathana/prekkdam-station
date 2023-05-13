@extends('layouts.pdf-layout')

@section('html')
    <div class="text-center heading-title-center khmer-moul"><h4>កាលវិភាគសងប្រាក់</h4></div>
    <br>
    <br>
    <div class="row">
        <table style="width: 100%; font-size:12px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>កូដអតិថិជន</td>
                <td>{{$loan->client->code}}</td>                
                <td>លេខកូដកម្ចី</td>
                <td>{{$loan->code}}</td> 
            </tr>
            <tr>                                           
                <td >អតិថិជន</td>
                <td>{{$loan->client->name_kh}}</td>        
                <td>លេខទូរសព្ទ</td>
                <td>{{$loan->client->phone_number}}</td>        
            </tr>
            <tr>
                <td>អាសយដ្ឋាន</td>
                <td>{{$loan->client->address}}</td>                
            </tr>
            <tr>                
                <td>ចំនួនទឹកប្រាក់</td>
                <td>{{ number_format($loan->principal_amount) }}</td>
                <td>ការប្រាក់</td>
                <td>{{$loan->rate}} %</td>
            </tr>
            <tr>
                <td>ថ្ងៃសងដំបូង</td>
                <td>{{$loan->start_end_interest_date}}</td>

                <td>រយៈពេល(ខែ)</td>
                <td>{{$loan->term}} </td>
            </tr>
            <tr>
                
                <td>ថ្ងៃសង់ផ្តាច់</td>
                <td>{{$loan->last_end_interest_date}} </td>
            </tr>
        </table>
    </div>
    
    <div class="text-right">
        <small class="print-date"><i>printed at {{ \Carbon\Carbon::now() }}</i></small>   
    </div>
    <div class="report" id="report">             
        <table class="th-color">
            <tr>                
                <th style="width: 50px;" rowspan="2">ល.រ</th>
                <th style="width: 150px;" rowspan="2">ថ្ងៃត្រូវបង់</th>
                <th style="width: 100px;" rowspan="2">សមតុល្យ</th>
                <th style="width: 100px;" rowspan="2">សងដើម</th>
                <th style="width: 100px;" rowspan="2">ការប្រាក់</th>
                <th style="width: 100px;" rowspan="2">សរុប</th>                
                <th style="width: 150px;" colspan="2">ហត្តលេខា</th>
            </tr>
            <tr>
                <th style="width: 150px;">អ្នកខ្ចី</th>                
                <th style="width: 150px;">បេឡា</th>
            </tr>

            @foreach ($loan->payments as $payment)                
                <tr>
                    <td class="text-center text-nowrap" style="height: 35px">{{ $loop->index + 1 }}</td>
                    <td class="text-left" nowrap="nowrap">{{ $payment->end_interest_date }} &ensp; {{ convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('end_interest_date'))))}} </td>
                    <td class="text-right text-nowrap">{{ number_format($payment->pending_amount) }} </td>                
                    <td class="text-right text-nowrap">{{ number_format($payment->deduct_amount) }}</td>
                    <td class="text-right" >{{ number_format($payment->interest_amount) }} </td>
                    <td class="text-right text-nowrap">{{ number_format($payment->total_amount) }} </td>                    
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