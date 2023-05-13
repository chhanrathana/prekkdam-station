@extends('layouts.app')
@section('title',__('page-titles.loan_payment_edit'))
@section('content')
        
    @include('operations.clients.info',['record' => $record->loan->client])

    @include('operations.loans.requests.info', ['record' => $record->loan])

    <form action="{{ route('operation.loan.payment.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('operations.loans.payments.form')
    </form>
@endsection
