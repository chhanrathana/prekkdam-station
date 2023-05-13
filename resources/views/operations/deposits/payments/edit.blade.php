@extends('layouts.app')
@section('title',__('page-titles.deposit_payment_edit'))
@section('content')
    
    @include('operations.clients.info',['record' => $record->deposit->client])

    @include('operations.deposits.requests.info', ['record' => $record->deposit])

    <form action="{{ route('operation.deposit.payment.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')

        @include('operations.deposits.payments.form')

    </form>
@endsection
