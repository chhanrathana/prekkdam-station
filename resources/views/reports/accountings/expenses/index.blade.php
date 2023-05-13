@extends('layouts.app')
@section('title' ,  __('page-titles.accounting_expense'))

@section('content')
    @include('reports.accountings.expenses.search')
    @include('reports.accountings.expenses.list')
@endsection