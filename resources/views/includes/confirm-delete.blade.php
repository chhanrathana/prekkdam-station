<form action="" method="POST" id="frmDelete">
    @csrf
    @method('DELETE')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">លុបទិន្នន័យ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            	<span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            អ្នកពិតជាចង់លុបប្រាកដមែន ឫទេ?
        </div>
        <div class="modal-footer">
            <button type="button" type="submit" onclick="submit()" class="btn btn-sm btn-danger">
				<span class="material-icons">delete_forever</span>
			</button>
        </div>
        </div>
    </div>
    </div>
</form>
