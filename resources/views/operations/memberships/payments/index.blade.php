@extends('layouts.app')
@section('title' ,  __('page-titles.deposit_payment_index'))

@section('content')
    @include('operations.memberships.payments.search')
    @include('operations.memberships.payments.list')
@endsection