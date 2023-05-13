@extends('layouts.app')
@section('title',__('page-titles.client_create'))
@section('content')    
    <form action="{{ route('operation.client.store') }}" method="POST">
        @csrf
        @include('operations.clients.form', ['hadPhoto' => 0])
    </form>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('/js/geolocation.js') }}"></script>
@endsection
