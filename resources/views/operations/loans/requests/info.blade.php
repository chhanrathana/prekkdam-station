<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-info"></i>
        <strong>{{ __('form.loan_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.type') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->type->name_kh??'' }}</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.loan_code') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->code }}</label>
            </div>
            
            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.principal_amount') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ number_format($record->principal_amount) }} KHR</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.interest_rate') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ number_format($record->interest_rate,2) }} %</label>
            </div>
           
             <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.registration_date') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->registration_date }}</label>
            </div>
           
            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.start_interest_date') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->start_interest_date }}</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.term') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->term }}</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.update_balance_date') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->update_balance_date }}</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.balance_amount') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ number_format($record->balance_amount,2) }} KHR</label>
            </div>
        </div>
    </div>
</div>