@extends('layouts.app')
@section('title',__('page-titles.master_data_deposit_edit'))

@section('content')
    <form action="{{ route('setting.master-data.operation.deposit.request.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('settings.master-data.deposits.form')
    </form>
@endsection
