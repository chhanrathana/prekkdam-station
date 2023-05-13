@extends('layouts.app')
@section('title', __('page-titles.client_show'))

@section('content')
    @include('operations.clients.info')    
@endsection
