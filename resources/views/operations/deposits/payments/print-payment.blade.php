@extends('layouts.pdf-layout-repay')

@section('html')
    <div class="text-center heading-title-center khmer-moul">
        តារាងប្រាក់កម្ចី
    </div>

    
    <div class="report repay" id="report">
        <br/>        
        <div class="text-right">
            <small class="print-date"><i>printed at {{ \Carbon\Carbon::now() }}</i></small>   
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" style="font-size: 8px">
                <thead>                    

                    <tr style="background-color: rgb(236, 236, 236);">
                        <th style="width: 28px;" class="text-center">ល.រ</th>
                        <th style="width: 50px;" class="text-center text-nowrap">ត្រូវបង់</th>
                        <th style="width: 65px;" class="text-center text-nowrap">ប្រភេទ</th>
                        <th style="width: 50px;" class="text-center text-nowrap">ប្រាក់ខ្ចី</th>
                        <th style="width: 35px;" class="text-center text-nowrap">កូដ</th>
                        <th style="width: 100px;" class="text-center text-nowrap">អតិថិជន</th>
                        <th style="width: 70px;" class="text-center text-nowrap">ទំនាក់ទំនង</th>
                        <th style="width: 25px;" class="text-center text-nowrap">យឺត</th>                        
                        <th style="width: 75px;" class="text-center text-nowrap">សមតុល្យ</th>
                        <th style="width: 50px;" class="text-center text-nowrap">ត្រូវបង់</th>
                        <th style="width: 50px;" class="text-center text-nowrap">បានបង់</th>
                        <th style="width: 45px;" class="text-center text-nowrap">បង់ទី</th>
                        <th style="width: 180px;" class="text-center text-nowrap">អាសយដ្ឋាន</th>
                    </tr> 
                </thead>
                <tbody>
                @php
                    $totalPending = 0;
                    $totalAmount = 0;
                    $totalPaidAmount = 0;
                    $totalUnPaidAmount = 0;
                    $i = 1;
                @endphp
                @foreach ($early as $payment)
                    @php
                        $totalPending +=  $payment->loan->pending_amount??0;
                        $totalAmount +=  $payment->total_amount;
                        $totalPaidAmount +=$payment->total_paid_amount;
                        $unPaidAmount = ($payment->total_amount - $payment->total_paid_amount);                        
                        $totalUnPaidAmount += $unPaidAmount;
                    @endphp
                    <tr>
                        <td class="text-right text-nowrap">{{ $i++ }}</td>
                        <td class="text-center text-nowrap">{{ $payment->end_interest_date??''}}</td>
                        <td class="text-left text-nowrap">{{ $payment->loan->interest->name_kh??''}}</td>
                        <td class="text-right text-nowrap">{{ number_format(($payment->loan->principal_amount??0)) }}</td>
                        <td class="text-left text-nowrap">{{ $payment->loan->client->code??''}}</td>
                        <td class="text-left text-nowrap">{{ $payment->loan->client->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $payment->loan->client->phone_number??''}}</td>
                        <td class="text-right text-nowrap">{{ $payment->countLateDay() }}</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->loan->pending_amount??0) }}</td>
                        <td class="text-right text-nowrap">{{ number_format($unPaidAmount??0)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->total_paid_amount??0)}}</td>
                        <td class="text-center text-nowrap">{{ number_format($payment->sort) .'/'.($payment->loan->term ?? '') }}</td>
                        <td class="text-left text-nowrap">{{ $payment->loan->client->address??''}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-right" colspan="8"><strong>សរុប</strong></td>
                    <td class="text-right text-nowrap">{{ number_format($totalPending) }}</td>
                    <td class="text-right text-nowrap">{{ number_format($totalUnPaidAmount) }}</td>
                    <td class="text-right text-nowrap">{{ number_format($totalPaidAmount) }}</td>
                    <td class="text-right" colspan="2">PAR : {{ $totalPending <= 0? 'N/A' : sprintf("%.2f%%", ($totalAmount / $totalPending) * 100) }}</td>
                </tr>
                <tr>
                    <td class="text-left" colspan="14">យឺត</td>
                </tr>
                @php
                    $totalLatePending = 0;
                    $totalLateAmount = 0;
                    $totalLatePaidAmount = 0;
                    $totalLateUnPaidAmount = 0;
                    $i = 1;
                @endphp
                @foreach ($late as $payment)
                    @php
                        $totalLatePending += $payment->loan->pending_amount??0;
                        $totalLateAmount += $payment->getTotalUnPaidAmount();
                        $totalLatePaidAmount += $payment->total_paid_amount;
                        $unPaidLateAmount = ($payment->total_amount - $payment->total_paid_amount);
                        $totalLateUnPaidAmount += $unPaidLateAmount;
                    @endphp
                    <tr>
                        <td class="text-right text-nowrap">{{ $i++ }}</td>
                        <td class="text-center text-nowrap">{{ $payment->end_interest_date??''}}</td>
                        <td class="text-left text-nowrap">{{ $payment->loan->interest->name_kh??''}}</td>
                        <td class="text-right text-nowrap">{{ number_format(($payment->loan->principal_amount??0)) }}</td>
                        <td class="text-left text-nowrap">{{ $payment->loan->client->code??''}}</td>
                        <td class="text-left text-nowrap">{{ $payment->loan->client->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $payment->loan->client->phone_number??''}}</td>
                        <td class="text-right text-nowrap">{{ $payment->countLateDay() }}</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->loan->pending_amount??0) }}</td>
                        <td class="text-right text-nowrap">{{ number_format($unPaidLateAmount??0)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->total_paid_amount??0)}}</td>
                        <td class="text-center text-nowrap">{{ number_format($payment->sort).'/'.($payment->loan->term ?? '') }}</td>
                        <td class="text-left text-nowrap">{{ $payment->loan->client->address??''}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-right" colspan="8"><strong>សរុបយឺត</strong></td>
                    <td class="text-right text-nowrap">{{ number_format($totalLatePending) }}</td>
                    <td class="text-right text-nowrap">{{ number_format($totalLateAmount) }}</td>
                    <td class="text-right text-nowrap">{{ number_format($totalLatePaidAmount) }}</td>
                    {{-- <td class="text-right" colspan="2">PAR : {{ $totalLatePending <= 0? 'N/A' : sprintf("%.2f%%", ($totalLateAmount / $totalLatePending) * 100) }}</td> --}}
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
