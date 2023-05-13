$(document).ready(function () {
  getAddress("#province_id", "district");
  getAddress("#district_id", "commune");
  getAddress("#commune_id", "village");

  function getAddress (id, address) {
      $(id).change(function (event) {
          if ($(this).val() == '') {
              return;
          }
          $.ajax({
              type: 'GET',
              url: '/address/'+ address +'/' + $(this).val(),
              success: function (response) {
                  if (response) {
                      $(`#${address}_id`).html('');
                      var options = '<option value="" selected>[-- ជ្រើសរើស --]</option>';
                      $.each(response, function (index, item) {
                          options = options + '<option value="' + response[index].id + '">' + response[index].name_kh + '</option>';
                      });
                      $(`#${address}_id`).html(options);
                      $('.').selectpicker('refresh');
                  }
              }
          });
      });
  }
});
