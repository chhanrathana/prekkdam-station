@extends('layouts.app')
@section('title' ,  __('page-titles.sale_request_create'))

@section('content')    
    {{-- @include('includes.search-client', ['url' => route('operation.sale.request.create')]) --}}
    {{-- @include('operations.clients.info', ['record' => $client]) --}}
    
    <form action="{{ route('operation.sale.request.store') }}" method="POST">
        @csrf
        <input type="hidden" name="client_id" value="{{ $client->id??'' }}">
        @include('operations.sales.requests.form')
    </form>
@endsection
