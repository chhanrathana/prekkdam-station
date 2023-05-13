@extends('layouts.app')
@section('title' ,  __('page-titles.deposit_request_index'))
@section('content')    
    @include('operations.deposits.requests.search')    
    @include('operations.deposits.requests.list')    
    @include('includes.confirm-delete')
    
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/deposit/list/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
