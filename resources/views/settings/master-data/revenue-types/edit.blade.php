@extends('layouts.app')
@section('title',__('page-titles.master_data_revenue_type_edit'))

@section('content')
    <form action="{{ route('setting.master-data.revenue-type.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('settings.master-data.revenue-types.form')
    </form>
@endsection
