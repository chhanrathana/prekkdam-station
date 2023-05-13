@extends('layouts.app')
@section('title',__('page-titles.revenue_edit'))
@section('content')

    <form action="{{ route('revenue.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('operations.revenues.form')            
    </form>
    
@endsection