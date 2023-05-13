@extends('layouts.app')
@section('title',__('page-titles.user_edit'))

@section('content')
    <form action="{{ route('setting.user.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('settings.users.form')
    </form>
@endsection
