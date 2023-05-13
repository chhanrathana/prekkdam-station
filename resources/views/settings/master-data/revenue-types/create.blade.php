@extends('layouts.app')
@section('title',__('page-titles.master_data_revenue_type_create'))

@section('content')    
    <form action="{{ route('setting.master-data.revenue-type.store') }}" method="POST">
        @csrf
        @include('settings.master-data.revenue-types.form') 
    </form>
@endsection
