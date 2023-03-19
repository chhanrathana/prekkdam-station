
@extends('layouts.app')
@section('breadcrumb')
    @include('master-data.customers.breadcrumb')  
@endsection
@section('content')
    @include('master-data.customers.table')
@endsection