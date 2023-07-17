@extends('layouts.app')
@section('title' ,  __('page-titles.report_operation_sale'))

@section('content')
    @include('reports.operations.sales-daily.search')
    @include('reports.operations.sales-daily.list')
@endsection