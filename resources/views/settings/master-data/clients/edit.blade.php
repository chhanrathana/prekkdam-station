@extends('layouts.app')
@section('title',__('page-titles.master_data_client_edit'))

@section('content')
    <form action="{{ route('setting.master-data.client.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('settings.master-data.clients.form')
    </form>
@endsection