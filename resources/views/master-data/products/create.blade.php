@extends('layouts.app')
@section('breadcrumb')
    @include('master-data.products.breadcrumb')  
@endsection

@section('content')
    @include('shared.alert')        
    <form class="needs-validation" novalidate action="{{ route('master-data.product.store') }}" method="POST">
        @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-info"><strong><i class="fa fa-plus"></i> Add New</strong></h3>
                </div>
                <div class="card-body">                                            
                    @include('master-data.products.form')                                            
                </div>
                <div class="card-footer">
                    @include('shared.form-footer',['route' => route('master-data.product.index')])
                </div>
            </div>        
        </form>
@endsection