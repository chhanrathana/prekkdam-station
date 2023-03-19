@extends('layouts.app')
@section('breadcrumb')
    @include('master-data.product-types.breadcrumb')  
@endsection

@section('content')
    @include('shared.alert')            
    <form class="needs-validation" novalidate action="{{ route('master-data.product-type.update' , ['id' => $item -> id]) }}" method="POST">
            @method('PATCH')
        @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-info"><strong><i class="fa fa-plus"></i> Edit Product Type</strong></h3>
                </div>
                <div class="card-body">                                            
                    @include('master-data.product-types.form')                                            
                </div>
                <div class="card-footer">
                    @include('shared.form-footer',['route' => route('master-data.product-type.index')])
                </div>
            </div>        
        </form>
@endsection