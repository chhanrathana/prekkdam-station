@extends('layouts.app')
@section('title' ,  __('page-titles.report_operation_sale'))

@section('content')
    @include('reports.operations.sales.search')
    @include('reports.operations.sales.list')
@endsection