@extends('layouts.app')
@section('title',__('page-titles.master_data_loan_edit'))

@section('content')
    <form action="{{ route('setting.master-data.operation.loan.request.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('settings.master-data.loans.form')
    </form>
@endsection
