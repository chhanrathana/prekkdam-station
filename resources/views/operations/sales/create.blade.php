@extends('layouts.app')
@section('title' ,  __('page-titles.sale_request_create'))

@section('content')        
    <form action="{{ route('operation.sale.store') }}" method="POST">
        @csrf
        @include('operations.sales.form')
    </form>
@endsection

@section('script')
    {{-- <script>

    $('#form-check-settlement').on('submit',function ($event){
            $event.preventDefault();
            const formData = $(this).serializeArray();
            if($(this).valid()){
                $.ajax({
                    url : '{{ route('report.close-settlement-transaction.search-settlement') }}',
                    type : 'POST',
                    data : formData,
                    beforeSend : function (){
                        $('#btn-check-settlement').prop('disabled',true);
                        $('#btn-check-settlement').addClass("btn-loading");
                    },
                    success : function (res){
                        $('body').find('#search-content').html(res);
                        $('#btn-check-settlement').prop('disabled',false);
                        $('#btn-check-settlement').removeClass("btn-loading");
                    },
                    error : function (){

                    }
                })
            }
        });
    </script> --}}
@endsection