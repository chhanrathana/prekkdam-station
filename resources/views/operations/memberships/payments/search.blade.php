<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-search"></i>
        <strong>{{ __('form.search') }}</strong>
    </div>
    <div class="card-body">
        <form action="{{ route('operation.membership.payment.index') }}" class="mt-2" id="frmSearch" method="GET">
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
                        name="end_interest_date"
                        value="{{ request('end_interest_date')??$paymeneDate }}"
                        placeholder="{{ __('form.end_interest_date') }}">
                </div>                             
            
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="deposit_code"
                        maxlength="50"
                        value="{{ request('deposit_code') }}"
                        placeholder="{{ __('form.deposit_code') }}">
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
                    <a href="{{route('operation.membership.payment.index')}}" class="btn btn-warning mb-2">
                        <i class="fas fa-times"></i>
                        {{ __('form.clear') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>