@extends('layouts.app')
@section('title' ,  __('page-titles.accounting_balancesheet'))

@section('content')
    @include('reports.accountings.balancesheets.search')
    @include('reports.accountings.balancesheets.list')
@endsection