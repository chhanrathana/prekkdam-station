@extends('layouts.app')
@section('title' , __('page-titles.expense_list'))
@section('content')
    @include('operations.expenses.search')
    @include('operations.expenses.list')    
    @include('includes.confirm-delete')
    
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/expense/list/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
