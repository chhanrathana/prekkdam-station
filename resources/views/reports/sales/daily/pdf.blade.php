@extends('layouts.pdf-layout')

@section('html')
    <div class="text-center heading-title-center khmer-moul">
        តារាងលក់ប្រចាំថ្ងៃ
        <br/>
        {{  $date }} 
    </div>
    <div class="text-right" style="font-size: 9px">
        <small class="print-date"><i>printed at {{ \Carbon\Carbon::now() }}</i></small>   
    </div>
    @include('reports.sales.daily.table')
    
    <table style="width:100%; line-height: 3; border: 0px solid rgba(255, 255, 255, 0) !important;">
        <tr style="border: 0px solid rgba(255, 255, 255, 0) !important;">
            <th style="text-align:center; border: 0px solid rgba(255, 255, 255, 0) !important;">
                <div class="caption-left">
                <div class="text-center">
                  
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
                            <p class="p">ថ្ងៃ............. ខែ............. ឆ្នាំ {{ \Carbon\Carbon::now()->format('Y') }}</p>
                        </div>
                        <div class="khmer-os" style="pandding-left:20px;">អ្នកធ្វើរបាយការណ៍</div>
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
@endsection