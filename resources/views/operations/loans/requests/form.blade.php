<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.loan_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">      
            <div class="form-group col-sm-4">
                <label >{{ __('form.type') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('loan_type_id') ? 'is-invalid':'' }}"  name="loan_type_id" id="loan_type_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($types as $type)
                        @isset ($record)
                            <option value="{{ $type->id }}" {{ $record->loan_type_id == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @else
                            <option value="{{ $type->id }}" {{  old('loan_type_id') == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('loan_type_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.principal_amount') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control number {{ $errors->first('principal_amount') ? 'is-invalid':'' }}"
                    name="principal_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    value="{{ $record->principal_amount??old('principal_amount') }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('principal_amount') }}</div>
            </div>
            
            <div class="form-group col-sm-4">
                <label>{{ __('form.inerest_rate') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control number {{ $errors->first('rate') ? 'is-invalid':'' }}"
                    name="interest_rate"
                    pattern="[0-9.]+"
                    type="text"
                    placeholder="0.7"
                    maxlength="6"
                    value="{{ $record->interest_rate??0 }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.admin_fee_amount') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control number {{ $errors->first('admin_fee_amount') ? 'is-invalid':'' }}"
                    name="admin_fee_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="1000000"
                    value="{{ $record->admin_fee_amount??old('admin_fee_amount') }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('admin_fee_amount') }}</div>
            </div>
          
            <div class="form-group col-sm-4">
                <label>{{ __('form.registration_date') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('registration_date') ? 'is-invalid':'' }}"
                    name="registration_date"
                    type="text"
                    maxlength="10"
                    pattern="[0-9/]+"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    {{-- value="{{ $record->registration_date??old('registration_date') }}" --}}
                    value="{{ $record->registration_date??$registrationDate }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('registration_date') }}</div>
            </div>
            
            <div class="form-group col-sm-4">
                <label>{{ __('form.start_interest_date') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('start_interest_date') ? 'is-invalid':'' }}"
                    name="start_interest_date"
                    type="text"
                    maxlength="10"
                    pattern="[0-9/]+"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    value="{{ $record->start_interest_date??$startInterestDate }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('start_interest_date') }}</div>
            </div>
            
            <div class="form-group col-sm-4">
                <label>{{ __('form.term') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control term {{ $errors->first('term') ? 'is-invalid':'' }}"
                    name="term"
                    pattern="\d*"
                    type="text"
                    placeholder="12"
                    value="{{ $record->term??old('term') }}"
                    maxlength="2">
                <div class="invalid-feedback">{{ $errors->first('term') }}</div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <a class="btn btn btn-warning float-left" href="{{ route('operation.loan.request.index')}}">
                    <i class="fas fa-arrow-left"></i>  {{ __('form.btn_back') }}
                </a>

                <button class="btn btn btn-success float-right" type="submit" {{ !$client?'disabled':'' }}>                    
                    <i class="fas fa-save"></i>  {{ __('form.btn_save') }}
                </button>
            </div>
        </div>
    </div>  
</div>