{{-- @extends('layouts.app')
@section('title' ,  __('page-titles.sale_request_create'))

@section('content')        
    <form action="{{ route('operation.sale.store') }}" method="POST" id="form">
        @csrf
        @include('operations.sales.form')
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".motor-change").change(function () {
                suggestMotorValue();
            });
        });

        function suggestMotorValue(){
            $.ajax({
                url : '{{ route('operation.sale.motor') }}',
                type: "GET",                
                data: $('#form').serialize(),
                beforeSend: function() {
                    console.log('loading')
                },
                success: function (response) {
                    console.log('reposnse...',response)                   
                    // console.log(response.record.new_motor_left);
                    $('#old_motor_left').val(parseFloat(response.record.new_motor_left));    
                    $('#old_motor_right').val(parseFloat(response.record.new_motor_right));    
              
                },
                error: function(xhr) {                   
                    console.log("Error : " + xhr.statusText + xhr.responseText);
                }
            });
        }
    </script>    --}}
@endsection