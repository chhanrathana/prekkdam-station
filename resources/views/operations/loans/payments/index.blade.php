@extends('layouts.app')
@section('title' ,  __('page-titles.loan_payment_index'))

@section('content')
    @include('operations.loans.payments.search')
    @include('operations.loans.payments.list')
@endsection