@extends('layouts.app')
@section('title',__('page-titles.master_data_loan_create'))

@section('content')    
    <form action="{{ route('setting.master-data.operation.loan.request.store') }}" method="POST">
        @csrf
        @include('settings.master-data.loans.form') 
    </form>
@endsection
