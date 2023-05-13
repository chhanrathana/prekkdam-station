@extends('layouts.app')
@section('title' ,  __('page-titles.accounting_cashflow'))

@section('content')
    @include('reports.accountings.cashflows.search')
    @include('reports.accountings.cashflows.list')
@endsection