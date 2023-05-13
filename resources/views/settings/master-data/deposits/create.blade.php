@extends('layouts.app')
@section('title',__('page-titles.master_data_deposit_create'))

@section('content')    
    <form action="{{ route('setting.master-data.operation.deposit.request.store') }}" method="POST">
        @csrf
        @include('settings.master-data.deposits.form') 
    </form>
@endsection
