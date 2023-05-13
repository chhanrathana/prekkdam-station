@extends('layouts.app')
@section('title',__('page-titles.master_data_expense_type_edit'))

@section('content')
    <form action="{{ route('setting.master-data.expense-type.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('settings.master-data.expense-types.form')
    </form>
@endsection
