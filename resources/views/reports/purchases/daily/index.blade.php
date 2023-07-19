@extends('layouts.app')
@section('title' ,  __('page-titles.report_operation_purchase'))

@section('content')
    @include('reports.purchases.daily.search')
    @include('reports.purchases.daily.list')
@endsection