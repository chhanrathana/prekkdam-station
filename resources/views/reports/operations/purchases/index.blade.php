@extends('layouts.app')
@section('title' ,  __('page-titles.operation_purcahse'))

@section('content')
    @include('reports.operations.purchases.search')
    @include('reports.operations.purchases.list')
@endsection