@extends('layouts.app')
@section('title' ,  __('page-titles.report_operation_purchasse'))

@section('content')
    @include('reports.operations.purchases.search')
    @include('reports.operations.purchases.list')
@endsection