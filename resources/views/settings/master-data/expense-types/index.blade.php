@extends('layouts.app')
@section('title',__('page-titles.master_data_expense_type_index'))
    
@section('content')
    {{-- @include('settings.master-data.expense-types.search') --}}
    @include('settings.master-data.expense-types.list')
    @include('includes.confirm-delete')
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/setting/master-data/expense-type/'+$(this).attr("data-id");
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection