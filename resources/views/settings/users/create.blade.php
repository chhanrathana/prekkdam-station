@extends('layouts.app')
@section('title',__('page-titles.user_create'))

@section('content')    
    <form action="{{ route('setting.user.store') }}" method="POST">
        @csrf
        @include('settings.users.form') 
    </form>
@endsection
