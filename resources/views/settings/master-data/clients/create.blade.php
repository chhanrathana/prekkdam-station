@extends('layouts.app')
@section('title',__('page-titles.master_data_client_create'))

@section('content')    
    <form action="{{ route('setting.master-data.client.store') }}" method="POST">
        @csrf
        @include('settings.master-data.clients.form')
    </form>
@endsection
