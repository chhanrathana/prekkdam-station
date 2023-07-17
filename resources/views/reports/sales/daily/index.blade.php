@extends('layouts.app')
@section('title' ,  __('page-titles.report_operation_sale'))

@section('content')
    @include('reports.sales.daily.search')
    @include('reports.sales.daily.list')
@endsection