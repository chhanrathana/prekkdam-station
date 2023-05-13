@extends('layouts.app')
@section('title' ,  __('page-titles.memberships_request_create'))

@section('content')
    
    @include('includes.search-client', ['url' => route('operation.membership.request.create')])
    @include('operations.clients.info')
    
    <form action="{{ route('operation.membership.request.store') }}" method="POST">
        @csrf
        <input type="hidden" name="client_id" value="{{ $client->id??'' }}">
        @include('operations.memberships.requests.form')
    </form>
@endsection