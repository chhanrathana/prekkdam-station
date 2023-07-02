@extends('layouts.app')
@section('title',__('page-titles.master_data_oil_type_edit'))

@section('content')
    <form action="{{ route('setting.master-data.oil-type.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('settings.master-data.oil-types.form')
    </form>
@endsection
