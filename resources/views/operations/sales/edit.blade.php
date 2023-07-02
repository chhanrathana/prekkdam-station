@extends('layouts.app')
@section('title' ,  __('page-titles.sale_request_edit'))

@section('content')        
    
    <form action="{{ route('operation.sale.update',['id' => $record->id]) }}" method="POST">
        @csrf
        @method('PATCH')        
        <input type="hidden" name="oil_sale_id" value="{{ $record->id??'' }}">
        @include('operations.sales.form')
    </form>
@endsection