@extends('layouts.app')
@section('title', __('page-titles.loan_show'))

@section('content')
    @include('operations.clients.info', ['record' => $record->client])
    @include('operations.loans.requests.info')
    @include('operations.loans.requests.schedule')
@endsection
