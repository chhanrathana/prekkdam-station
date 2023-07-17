@extends('layouts.app')
@section('title' ,  __('page-titles.report_operation_purchasse'))

@section('content')
    @include('reports.purchases.stock.list')
@endsection