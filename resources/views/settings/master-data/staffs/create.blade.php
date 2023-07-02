@extends('layouts.app')
@section('title',__('page-titles.master_data_staff_create'))

@section('content')    
    <form action="{{ route('setting.master-data.staff.store') }}" method="POST">
        @csrf
        @include('settings.master-data.staffs.form')
    </form>
@endsection
