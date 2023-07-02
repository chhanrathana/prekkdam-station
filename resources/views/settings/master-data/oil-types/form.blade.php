<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.oil_type_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" value="{{ $record->id??'' }}" name="expense_id">                    
            <div class="form-group col-sm-4">
                <label>{{ __('form.name_kh') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('name_kh') ? 'is-invalid':'' }}"
                    name="name_kh"
                    type="text"
                    placeholder="ឯកសារ"
                    value="{{ $record->name_kh??old('name_kh') }}"
                    maxlength="50" >
                <div class="invalid-feedback">{{ $errors->first('name_kh') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.name_en') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('name_en') ? 'is-invalid':'' }}"
                    name="name_en"
                    type="text"
                    placeholder="Document"
                    value="{{ $record->name_en??old('name_en') }}"
                    maxlength="50">
                <div class="invalid-feedback">{{ $errors->first('name_en') }}</div>
            </div>

            <div class="form-group col-sm-4">
            <label>{{ __('form.unit') }} <span class="text-danger">*</span></label>
                <div class="input-group">
                <input
                    class="form-control number {{ $errors->first('liter_of_ton') ? 'is-invalid':'' }}"
                    name="liter_of_ton"
                    pattern="[0-9.]+"
                    type="text"
                    placeholder="293777.7"
                    maxlength="6"
                    value="{{ (old('liter_of_ton')??$record->liter_of_ton??0)?? 0 }}"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('form.kg') }}</span>
                    </div>
                    <div class="invalid-feedback">{{ $errors->first('liter_of_ton') }}</div>
                </div>                      
            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a class="btn btn-warning float-left" href="{{ route('setting.master-data.oil-type.index') }}">
                        <i class="fas fa-arrow-left"></i> {{ __('form.btn_back') }}
                    </a>

                    <button class="btn btn-success float-right" type="submit">                    
                        <i class="fas fa-save"></i> {{ __('form.btn_save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>