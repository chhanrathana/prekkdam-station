@extends('layouts.app')
@section('title',__('page-titles.master_data_oil_type_create'))

@section('content')    
    <form action="{{ route('setting.master-data.oil-type.store') }}" method="POST">
        @csrf
        @include('settings.master-data.oil-types.form') 
    </form>
@endsection
