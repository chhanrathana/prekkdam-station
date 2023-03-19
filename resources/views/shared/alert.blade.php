
<div class="col-md-12">
    @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mb-1" role="alert">
        <span class="alert-inner--icon"><i class="fa fa-check"></i></span>
        <span class="alert-inner--text"><strong>ជោគជ័យ!</strong> {{\Session::get('success')}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    
    @if (\Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-1" role="alert">
        <span class="alert-inner--icon"><i class="fa fa-close"></i></span>
        <span class="alert-inner--text"><strong>មិនជោគជ័យ!</strong> {{\Session::get('error')}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
</div>
