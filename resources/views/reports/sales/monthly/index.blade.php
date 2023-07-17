@extends('layouts.app')
@section('title' ,  __('page-titles.report_operation_sale'))

@section('content')
    @include('reports.sales.monthly.search')
    @include('reports.sales.monthly.list')
@endsection