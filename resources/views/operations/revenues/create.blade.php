@extends('layouts.app')
@section('title',__('page-titles.revenue_create'))
@section('content')    
    <form action="{{ route('operation.revenue.store') }}" method="POST">
        @csrf
        @include('operations.revenues.form')
    </form>
@endsection
