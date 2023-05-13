@extends('layouts.app')
@section('title' , __('page-titles.client_list'))
@section('content')
    @include('operations.clients.search')
    @include('operations.clients.list')    
    @include('includes.confirm-delete')
    
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/loan/list/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
