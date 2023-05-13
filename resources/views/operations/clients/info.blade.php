<div class="card">
    <div class="card-header text-white bg-info">
        <i class="fas fa-info"></i>
        <strong>{{ __('form.client_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.client_code') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->code??'NA' }}</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.name_kh') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->name_kh??'NA' }}</label>
            </div>
            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.name_en') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->name_en??'NA' }}</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.sex') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->_sex->name_kh??'NA' }}</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.date_of_birth') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->date_of_birth??'NA' }}</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.phone_number') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->phone_number??'NA' }}</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.id_card_no') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->id_card_no??'NA' }}</label>
            </div>

            <div class="col-12 col-sm-6 col-md-6 form-group row">
                <label class="col-6 col-sm-4 col-form-label">{{ __('form.address') }}</label>
                <label class="col-6 col-sm-8 col-form-label font-weight-bold">{{ $record->address??'NA' }}</label>
            </div>
        </div>
    </div>
</div>