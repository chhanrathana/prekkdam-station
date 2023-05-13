@extends('layouts.app')
@section('title' ,  __('page-titles.deposit_payment_index'))

@section('content')
    @include('operations.deposits.payments.search')
    @include('operations.deposits.payments.list')
@endsection