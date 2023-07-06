@extends('layouts.app')
@section('title' ,  __('page-titles.purchase_request_edit'))

@section('content')            
    <form action="{{ route('operation.purchase.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="oil_purchase_id" value="{{ $record->id??'' }}">
        @include('operations.purchases.form')
    </form>
@endsection