@extends('layouts.app')
@section('content')  
    
    @php
        $totalClients = 0;
        $totalPrincipal = 0;
    @endphp
    <div class="row">

        
        {{-- @foreach ($interests as $interest) --}}
            {{-- @php
                $totalClients = $totalClients + $interest->count;
                $totalPrincipal = $totalPrincipal + $interest->principal_amount;
            @endphp --}}
            {{-- <div class="col-sm-6 col-lg-6">
                <div class="card">
                    <div class="card-header {{ $interest->css }} content-center">
                        <svg class="c-icon c-icon-3xl text-white my-4">
                        </svg>
                        <h4 class="text-font-bold text-primary big">{{ $interest->name_kh }}</h4>
    
                    </div>
                    <div class="card-body row text-center">
                        <div class="col">
                            <div class="text-value-xl">{{ number_format($interest->count) }}</div>
                            <div class="text-uppercase text-muted small text-font-bold">អតិថិជន</div>
                        </div>
                        <div class="c-vr"></div>
                        <div class="col">
                            <div class="text-value-xl">{{ number_format($interest->principal_amount) }}</div>
                            <div class="text-uppercase text-muted small text-font-bold">កម្ចី</div>
                        </div>
                    </div>
                </div>
            </div> --}}
        {{-- @endforeach --}}
    </div>
{{-- 
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header bg-default content-center">
                    <svg class="c-icon c-icon-3xl text-white my-4">
                    </svg>
                    <h4 class="text-font-bold text-primary big">សរុបទាំងអស់</h4>

                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="text-value-xl">{{ number_format($totalClients) }}</div>
                        <div class="text-uppercase text-muted small text-font-bold">អតិថិជន</div>
                    </div>
                    <div class="c-vr"></div>
                    <div class="col">
                        <div class="text-value-xl">{{ number_format($totalPrincipal) }}</div>
                        <div class="text-uppercase text-muted small text-font-bold">កម្ចី</div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@stop
