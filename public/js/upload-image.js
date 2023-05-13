// $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var image_crop = $('#image_demo').croppie({
        viewport: {
            width: 300,
            height: 300,
            type:'square'
        },
        boundary:{
            width: 320,
            height: 320
        }
    });

    /// catching up the cover_image change event aand binding the image into my croppie. Then show the modal.
    $('#file').on('change', function(){
        var reader = new FileReader();
        reader.onload = function (event) {
            image_crop.croppie('bind', {
                url: event.target.result,
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#modal-crop').modal('show');
    });

    function handleCrop(route){
        // CLOSE MODAL IF NOT CHANGE IMAGE
        if ($('body #file').get(0).files.length === 0) {
            $('body #modal-crop').modal('close');
            return;
        }
        image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response){
            $('body .img-thumbnail').attr('src',response);
            $('body #modal-crop').modal('hide');
            $.ajax({
                url : route,
                type: "POST",
                data : { file : response },
                success : function () {
                    $('body').find("#userAvatar").attr('src',response);
                }
            });
        })
    }
// });
    