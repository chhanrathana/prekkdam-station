<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.membership_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">
           
            <div class="form-group col-sm-4">
                <label>{{ __('form.principal_amount') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control number {{ $errors->first('principal_amount') ? 'is-invalid':'' }}"
                    name="principal_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    value="{{ $deposit->principal_amount??old('principal_amount') }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('principal_amount') }}</div>
            </div>
                      

            <div class="form-group col-sm-4">
                <label>{{  __('form.registration_date') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('registration_date') ? 'is-invalid':'' }}"
                    name="registration_date"
                    type="text"
                    maxlength="10"
                    pattern="[0-9/]+"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    {{-- readonly --}}
                    value="{{ $deposit->registration_date??$registrationDate }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('registration_date') }}</div>
            </div>                       
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <a class="btn btn btn-warning float-left" href="{{ route('operation.deposit.request.index')}}">
                    <i class="fas fa-arrow-left"></i>  {{ __('form.btn_back') }}
                </a>

                <button class="btn btn btn-success float-right" type="submit" {{ !$client?'disabled':'' }}>                    
                    <i class="fas fa-save"></i>  {{ __('form.btn_save') }}
                </button>
            </div>
        </div>
    </div>  
</div>