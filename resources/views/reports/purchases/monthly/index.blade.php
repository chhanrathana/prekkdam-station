@extends('layouts.app')
@section('title' ,  __('page-titles.report_operation_sale'))

@section('content')
    @include('reports.purchases.monthly.search')
    @include('reports.purchases.monthly.list')
@endsection