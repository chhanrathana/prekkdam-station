@extends('layouts.app')
@section('title',__('page-titles.expense_create'))
@section('content')    
    <form action="{{ route('operation.expense.store') }}" method="POST">
        @csrf
        @include('operations.expenses.form')
    </form>
@endsection
