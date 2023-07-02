@extends('layouts.app')
@section('content')  
    
<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-dashboard"></i>
        <strong>{{ __('form.oil_type_info') }}</strong>
    </div>
    <div class="card-body">
        @php
        $totalClients = 0;
        $totalPrincipal = 0;
    @endphp
    <div class="row">
        
        @foreach ($records as $reocrd)
            {{-- @php
                $totalClients = $totalClients + $interest->count;
                $totalPrincipal = $totalPrincipal + $interest->principal_amount;
            @endphp --}}
            <div class="col-sm-6 col-lg-6">
                <div class="card">
                    <div class="card-header {{ $reocrd->css }} content-center">
                        <svg class="c-icon c-icon-3xl text-white my-4">
                        </svg>
                        <h4 class="text-font-bold text-primary big">{{ $reocrd->name_kh }}</h4>
    
                    </div>
                    <div class="card-body row text-center">
                        <div class="col">
                            <div class="text-value-xl">{{ number_format($reocrd->purchases->sum('qty')??0,4) }} T</div>
                            <div class="text-uppercase text-muted small text-font-bold">{{ __('form.total') }}</div>
                        </div>
                        <div class="c-vr"></div>
                        <div class="col">
                            <div class="text-value-xl">{{ number_format($reocrd->purchases->sum('remain_qty')??0,4) }} T</div>
                            <div class="text-uppercase text-muted small text-font-bold">{{ __('form.in_stock') }} </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
</div>   
@stop
