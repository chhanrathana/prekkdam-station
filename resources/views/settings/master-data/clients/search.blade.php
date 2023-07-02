<div class="card">
        
    <div class="card-body">
        <form action="{{ route('setting.master-data.client.index') }}" class="mt-2" id="frmSearch" method="GET">
            <div class="form-row">             
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="code"
                        maxlength="5"
                        value="{{ request('code') }}"
                        placeholder="{{ __('form.code') }}">
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        maxlength="50"
                        value="{{ request('name') }}"
                        placeholder="{{ __('form.name') }}">
                </div>

                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">
                        <i class="fas fa-search"></i>
                        {{ __('form.search') }}
                    </button>
                    <a href="{{ url()->current() }}" class="btn btn-warning mb-2">
                        <i class="fas fa-times"></i>
                        {{ __('form.clear') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>