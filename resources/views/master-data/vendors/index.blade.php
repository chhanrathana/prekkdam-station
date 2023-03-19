
@extends('layouts.app')
@section('breadcrumb')
    @include('master-data.vendors.breadcrumb')  
@endsection
@section('content')
    @include('master-data.vendors.table')
@endsection