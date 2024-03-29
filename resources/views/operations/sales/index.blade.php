@extends('layouts.app')
@section('title' ,  __('page-titles.sale_request_index'))
@section('content')    
    @include('operations.sales.search')
    @include('operations.sales.list')
    @include('includes.confirm-delete')    
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/operation/sale/list/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
