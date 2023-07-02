@extends('layouts.app')
@section('title' ,  __('page-titles.sale_request_create'))

@section('content')        
    <form action="{{ route('operation.sale.store') }}" method="POST">
        @csrf
        @include('operations.sales.form')
    </form>
@endsection