@extends('layouts.app')
@section('title',__('page-titles.master_data_loan_index'))
    
@section('content')
    @include('settings.master-data.loans.search')
    @include('settings.master-data.loans.list')
    @include('includes.confirm-delete')
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/master-data/loan/'+$(this).attr("data-id");
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection