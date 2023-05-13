<!-- Vertically centered modal -->
<div class="modal" tabindex="-1" id="modal-crop" style="width:100vw">
    <div class="modal-dialog  modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">តម្រឹមរូបភាព</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="image_demo"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                <button type="button" class="btn btn-primary" onclick="handleCrop('{{ $imageRoute }}')" id="btn-crop-avatar">រួចរាល់</button>
            </div>
        </div>
    </div>
</div>