<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-search"></i>
        <strong>{{ __('form.search') }}</strong>
    </div>
    <div class="card-body">
        <form action="{{ route('setting.master-data.expense-type.index') }}" class="mt-2" id="frmSearch" method="GET">
            <div class="form-row">                
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        maxlength="10"
                        pattern="[0-9/]+"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="from_date"
                        value="{{ request('from_date') }}"
                        placeholder="{{ __('form.from_date') }}">
                </div>                             
            
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        maxlength="10"
                        pattern="[0-9/]+"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="to_date"
                        value="{{ request('to_date') }}"
                        placeholder="{{ __('form.to_date') }}">
                </div>  
                                                      
                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">
                        <i class="fas fa-search"></i>
                        {{ __('form.search') }}
                    </button>
                    <a href="{{route('setting.master-data.expense-type.index')}}" class="btn btn-warning mb-2">
                        <i class="fas fa-times"></i>
                        {{ __('form.clear') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>