@extends('layouts.app')
@section('title' ,  __('page-titles.deposit_request_create'))

@section('content')
    
    @include('includes.search-client', ['url' => route('operation.deposit.request.create')])
    @include('operations.clients.info', ['record' => $client])
    
    <form action="{{ route('operation.deposit.request.store') }}" method="POST">
        @csrf
        <input type="hidden" name="client_id" value="{{ $client->id??'' }}">
        @include('operations.deposits.requests.form')
    </form>
@endsection