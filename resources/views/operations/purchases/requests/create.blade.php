@extends('layouts.app')
@section('title' ,  __('page-titles.purchase_request_create'))

@section('content')    
    <form action="{{ route('operation.purchase.request.store') }}" method="POST">
        @csrf
        @include('operations.purchases.requests.form')
    </form>
@endsection
