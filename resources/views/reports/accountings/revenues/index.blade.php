@extends('layouts.app')
@section('title' ,  __('page-titles.accounting_revenue'))

@section('content')
    @include('reports.accountings.revenues.search')
    @include('reports.accountings.revenues.list')
@endsection