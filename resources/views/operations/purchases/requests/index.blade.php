@extends('layouts.app')
@section('title' ,  __('page-titles.loan_request_index'))
@section('content')    
    {{-- @include('operations.purchases.requests.search') --}}
    @include('operations.purchases.requests.list')
    @include('includes.confirm-delete')    
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/operation/purchase/request/list/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
