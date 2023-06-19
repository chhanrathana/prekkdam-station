@extends('layouts.app')
@section('title' ,  __('page-titles.loan_request_edit'))

@section('content')        
    @include('operations.clients.info', ['record' => $record->client])
    @include('operations.loans.requests.info')
    <form action="{{ route('operation.loan.request.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="client_id" value="{{ $record->client_id??'' }}">
        <input type="hidden" name="loan_id" value="{{ $record->id??'' }}">
        @include('operations.loans.requests.form', ['client' => $record->client??null])
    </form>
@endsection