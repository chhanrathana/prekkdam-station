$(document).ready(function () {
    $(":input[data-inputmask-alias]").inputmask();
    $('[data-toggle="tooltip"]').tooltip();
    $(".number").inputmask('Regex', {
        regex: "^[0-9]{1,9}(\\.\\d{1,2})?$"
    });

    $(".term").inputmask('Regex', {
        regex: "^[0-9]{1,3}?$"
    });
    $('.select2').select2();

    // $('.select2').selectpicker('refresh');

    //  $(".select2").select2({
    //      allowClear: false,
    //     //  placeholder: 'Position'
    //  });

    //  $("#province_id").select2({
    //     placeholder: 'ជ្រើសរើសខេត្ត'
    //  });

    //  $("#district_id").select2({
    //      placeholder: 'ជ្រើសរើសស្រុក'
    //  });

    //  $("#commune_id").select2({
    //      placeholder: 'ជ្រើសរើសឃុំ'
    //  });

    //  $("#village_id").select2({
    //      placeholder: 'ជ្រើសរើសភូមិ'
    //  });
});
