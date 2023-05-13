@extends('layouts.app')
@section('title',__('page-titles.master_data_expense_type_create'))

@section('content')    
    <form action="{{ route('setting.master-data.expense-type.store') }}" method="POST">
        @csrf
        @include('settings.master-data.expense-types.form') 
    </form>
@endsection
