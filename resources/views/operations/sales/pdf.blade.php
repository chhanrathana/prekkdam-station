@extends('layouts.pdf-layout')

@section('html')
    <div class="text-center heading-title-center">        
        តារាងលក់ប្រចាំថ្ងៃ
        <br/>
        {{-- {{  $fromDate }} - {{ $toDate }} --}}
    </div>
    <div class="text-right">
        <small class="print-date"><i>printed at {{ \Carbon\Carbon::now() }}</i></small>   
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id ="table">
            <thead>
                <tr>
                    <th class="text-center text-nowrap">{{ __('form.no') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.code') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.oil_type') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.shift') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.qty') }}</th>                        
                    <th class="text-center text-nowrap">{{ __('form.cost') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.total_cost') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.price') }}</th>
                    <th class="text-center text-nowrap">{{ __('form.total_price') }}</th>
                </tr>
            </thead>
            <tbody>                
            </tbody>
        </table>
    </div>   

    {{-- @include('reports.operations.sales.table') --}}
    
    {{-- <table style="width:100%; line-height: 3; border: 0px solid rgba(255, 255, 255, 0) !important;">
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
                        <div class="khmer-moul" style="pandding-left:20px;">អ្នកធ្វើរបាយការណ៍</div>
                        <br>
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
    </table>   --}}
@endsection