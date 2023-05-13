@extends('layouts.app')
@section('title' ,  __('page-titles.deposit_request_edit'))

@section('content')

    @include('operations.clients.info')
    @include('operations.deposits.requests.info')
    
    <form action="{{ route('operation.deposit.request.update',['id' => $deposit->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="client_id" value="{{ $deposit->client_id??'' }}">
        <input type="hidden" name="deposit_id" value="{{ $deposit->id??'' }}">
        @include('operations.deposits.requests.form')
    </form>
@endsection