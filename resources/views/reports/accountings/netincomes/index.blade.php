@extends('layouts.app')
@section('title' ,  __('page-titles.accounting_netincome'))

@section('content')
    @include('reports.accountings.netincomes.search')
    @include('reports.accountings.netincomes.list')
@endsection