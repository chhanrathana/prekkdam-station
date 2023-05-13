@extends('layouts.app')
@section('title' ,  __('page-titles.deposit_request_edit'))

@section('content')

    @include('operations.clients.info', ['record' => $record->client])
    @include('operations.deposits.requests.info')
    
    <form action="{{ route('operation.deposit.request.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="client_id" value="{{ $record->client_id??'' }}">
        <input type="hidden" name="deposit_id" value="{{ $record->id??'' }}">
        @include('operations.deposits.requests.form', ['client' => $record->client??null])
    </form>
@endsection