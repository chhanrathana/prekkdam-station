@extends('layouts.app')
@section('title', __('page-titles.depoist_request_show'))

@section('content')
    @include('operations.clients.info', ['record' => $record->client])
    @include('operations.memberships.requests.info')
@endsection