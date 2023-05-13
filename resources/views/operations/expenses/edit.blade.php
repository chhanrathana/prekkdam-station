@extends('layouts.app')
@section('title',__('page-titles.expense_edit'))
@section('content')

    <form action="{{ route('expense.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('operations.expenses.form') 
    </form>    
@endsection