@extends('layouts.app')
@section('title', 'បញ្ជីសាខា')
    
@section('content')
    
    @include('settings.master-data.branches.list')
    @include('includes.confirm-delete')
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/master-data/branch/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
