@extends('layouts.app')
@section('title' ,  __('page-titles.membership_request_index'))
@section('content')    
    @include('operations.memberships.requests.search')    
    @include('operations.memberships.requests.list')    
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
