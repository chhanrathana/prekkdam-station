@extends('layouts.app')
@section('title', 'បញ្ជីប្រតិទិនឈប់សម្រាក់')
    
@section('content')
    @include('settings.master-data.calendars.search')
    @include('settings.master-data.calendars.list')
    @include('includes.confirm-delete')
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/master-data/calendar/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
