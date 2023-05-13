@extends('layouts.app')
@section('title' , __('page-titles.revenue_list'))
@section('content')
    @include('operations.revenues.search')
    @include('operations.revenues.list')    
    @include('includes.confirm-delete')
    
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/revenue/list/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
