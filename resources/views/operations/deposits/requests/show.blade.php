@extends('layouts.app')
@section('title', __('page-titles.depoist_request_show'))

@section('content')
    @include('operations.clients.info')
    @include('operations.deposits.requests.info')
    @include('operations.deposits.payments.schedule')
@endsection