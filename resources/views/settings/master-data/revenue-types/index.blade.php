@extends('layouts.app')
@section('title',__('page-titles.master_data_revenue_type_index'))
    
@section('content')
    @include('settings.master-data.revenue-types.search')
    @include('settings.master-data.revenue-types.list')
    @include('includes.confirm-delete')
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/master-data/revenue-type/'+$(this).attr("data-id");
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection