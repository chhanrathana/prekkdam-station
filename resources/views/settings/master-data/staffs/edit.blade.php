@extends('layouts.app')
@section('title',__('page-titles.master_data_staff_edit'))

@section('content')
    <form action="{{ route('setting.master-data.staff.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('settings.master-data.staffs.form')
    </form>
@endsection