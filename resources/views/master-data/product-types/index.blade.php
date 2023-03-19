
@extends('layouts.app')
@section('breadcrumb')
    @include('master-data.product-types.breadcrumb')  
@endsection

@section('content')
    @include('master-data.product-types.table')      
@endsection

@push('script')
    
<script type="text/javascript">

// document.addEventListener("DOMContentLoaded", function() {
//   const forms = document.querySelectorAll('.needs-validation');
//   console.log(forms);
//   Array.prototype.slice.call(forms).forEach((form) => {
//     form.addEventListener('submit', (event) => {
//       if (!form.checkValidity()) {
//         event.preventDefault();
//         event.stopPropagation();
//       }
//       form.classList.add('was-validated');
//     }, false);
//   });
// });

  $(function () {
      
       
    // Render DataTable
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('master-data.product-type.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'detail', name: 'detail'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    // Click to Button
    $('#createNew').click(function () {
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#form').trigger("reset");
        $('#modelHeading').html("Create Product Type");
        $('#formModal').modal('show');
    });
      
   
   // Click to Edit Button
    $('body').on('click', '.editProduct', function () {
      var product_id = $(this).data('id');
      $.get("{{ route('master-data.product-type.edit',['id' => 's']) }}" +'/' + product_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#formModal').modal('show');
          $('#product_id').val(data.id);
          $('#name').val(data.name);
          $('#detail').val(data.detail);
      })
    });
      
    // Create New Product Type
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        // $(this).html('Sending..');
        console.log('sending....')
        $.ajax({
          data: $('#form').serialize(),
          url: "{{ route('master-data.product-type.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {       
              $('#form').trigger("reset");
              $('#formModal').modal('hide');
              table.draw();
          },
          error: function (data) {
            console.log(data.responseText.message);
            var message = JSON.stringify(data.responseText);
            var err = eval("(" + data.responseText + ")");
            console.log('Error:', err.message);
            console.log('Error:', message.message);
            $('#saveBtn').html('Save Changes');
          }
      });
    });

    // Delete Product Code
    $('body').on('click', '.deleteProduct', function () {     
        var product_id = $(this).data("id");
        confirm("Are You sure want to delete !");
        
        $.ajax({
            type: "DELETE",
            url: "{{ route('master-data.product-type.destroy',['id' => 's']) }}"+'/'+product_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });       
  });
</script>
@endpush