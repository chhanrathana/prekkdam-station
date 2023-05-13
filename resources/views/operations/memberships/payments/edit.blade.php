@extends('layouts.app')
@section('title','បង់ការប្រាក់')
@section('content')
    
    @include('operations.clients.info',['record' => $record->membership->client??null])

    @include('operations.memberships.requests.info',['record' => $record->membership])

    <form action="{{ route('deposit.membership.update',['id' => $payment->id]) }}" method="POST">
        @csrf
        @method('PATCH')

        @include('operations.memberships.payments.form')

    </form>
@endsection
