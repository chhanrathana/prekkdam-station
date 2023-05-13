@extends('layouts.pdf-layout')

@section('html')

    <div class="text-center heading-title-center khmer-moul">
         ប្រតិទិនឈប់សម្រាក់ប្រចាំឆ្នាំ {{ $year }}
    </div>

        
    <div class="report" id="report" style="margin-top: 50px"> 
            
        <table class="th-color">
            <tr>                
                <th style="width: 50px;">ល.រ</th>
                <th colspan="2" style="width: 180px;">ថ្ងៃ</th>                
                <th style="width: 300px;">ពិពណ៍នា</th>
                <th style="width: 200px;">ផ្សេងៗ</th>
            </tr>

            @foreach ($calendars as $calendar)                
                <tr>
                    <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                    <td class="text-center" >{{ $calendar->date??''}} </td>
                    <td class="text-center" nowrap="nowrap">{{ convertDaytoKhmer(date('D',strtotime($calendar->getRawOriginal('date')))) }}</td>                    
                    <td class="text-left text-nowrap">{{ $calendar->description }} </td>                    
                    <td class="text-right text-nowrap"></td>
                </tr>
            @endforeach
        </table>            
    </div>

@stop
