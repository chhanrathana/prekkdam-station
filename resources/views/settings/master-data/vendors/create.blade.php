@extends('layouts.app')
@section('title',__('page-titles.master_data_vendor_create'))

@section('content')    
    <form action="{{ route('setting.master-data.vendor.store') }}" method="POST">
        @csrf
        @include('settings.master-data.vendors.form')
    </form>
@endsection
