@extends('layouts.app')
@section('title',__('page-titles.client_edit'))
@section('content')

    @include('includes.modal-upload-image', ['imageRoute'=>  route('operation.client.updatePhoto',['id' => $client->id])  ])

    <form action="{{ route('operation.client.update',['id' => $client->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('operations.clients.form', ['hadPhoto' => 0])            
    </form>
    
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/geolocation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/upload-image.js') }}"></script>
@endsection