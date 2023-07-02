@extends('layouts.app')
@section('title',__('page-titles.master_data_vendor_edit'))

@section('content')
    <form action="{{ route('setting.master-data.vendor.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('settings.master-data.vendors.form')
    </form>
@endsection