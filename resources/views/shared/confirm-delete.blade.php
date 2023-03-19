<form action="" method="POST" id="frmDelete">
    @csrf
    @method('DELETE')       
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">លុបទិន្នន័យ</h5>
                    <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>អ្នកពិតជាចង់លុបប្រាកដមែន ឫទេ?</p>
                </div>
                <div class="modal-footer">
                    {{-- <button  class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button> --}}
                    <button class="btn btn-danger" type="button" type="submit" id="delete" onclick="submit()" >	
                        <i class="fa fa-remove"></i> {{ __('word.yes') }}
                    </button>
                </div>
            </div>
        </div>
    </div>    
</form>