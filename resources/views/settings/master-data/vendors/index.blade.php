@extends('layouts.app')
@section('title',__('page-titles.master_data_vendor_index'))
@section('content')
    @include('settings.master-data.vendors.search')
    @include('settings.master-data.vendors.list')
    @include('includes.confirm-delete')
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/setting/master-data/vendor/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
