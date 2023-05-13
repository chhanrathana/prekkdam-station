@extends('layouts.app')
@section('title' ,  __('page-titles.loan_request_create'))

@section('content')    
    @include('includes.search-client', ['url' => route('operation.loan.request.create')])
    @include('operations.clients.info', ['record' => $client])
    
    <form action="{{ route('operation.loan.request.store') }}" method="POST">
        @csrf
        <input type="hidden" name="client_id" value="{{ $client->id??'' }}">
        @include('operations.loans.requests.form')
    </form>
@endsection
