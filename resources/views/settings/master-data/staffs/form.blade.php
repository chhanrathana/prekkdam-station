<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.staff_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" value="{{ $record->id??'' }}" name="expense_id">                    
            <div class="form-group col-sm-4">
                <label>{{ __('form.code') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('code') ? 'is-invalid':'' }}"
                    name="code"
                    pattern="\d*"
                    type="text"
                    autocomplete="false"
                    placeholder="B001"
                    maxlength="5"
                    readonly
                    value="{{ (old('code')??$record->code??$code)?? $code }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('code') }}</div>
            </div>
            <div class="form-group col-sm-4">                
                <label>{{ __('form.name_kh') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('name_kh') ? 'is-invalid':'' }}"
                    name="name_kh"
                    type="text"
                    placeholder="រ៉ា ធារ៉ូត"
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
                    placeholder="RA THEAROTH"
                    value="{{ $record->name_en??old('name_en') }}"
                    maxlength="50">
                <div class="invalid-feedback">{{ $errors->first('name_en') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label >{{ __('form.sex') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('sex') ? 'is-invalid':'' }}"  name="sex">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($sexes as $sex)
                        @isset ($record)
                            <option value="{{ $sex->id }}" {{ $record->sex == $sex->id ? 'selected' :  '' }} >{{ $sex->name_kh}}</option>
                        @else
                            <option value="{{ $sex->id }}">{{ $sex->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('sex') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label >{{ __('form.date_of_birth') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('date_of_birth') ? 'is-invalid':'' }}"
                    name="date_of_birth"
                    type="text"
                    maxlength="10"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    data-val-required="Required"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    value="{{ $record->date_of_birth??old('date_of_birth') }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('date_of_birth') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label >{{ __('form.phone_number') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('phone_number') ? 'is-invalid':'' }}"
                    name="phone_number"
                    type="text"
                    placeholder="0967623XX"
                    value="{{ $record->phone_number??old('phone_number') }}"
                    maxlength="50"
                    >
                <div class="invalid-feedback">{{ $errors->first('phone_number') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label >{{ __('form.start_work_date') }}</label>
                <input
                    class="form-control {{ $errors->first('start_work_date') ? 'is-invalid':'' }}"
                    name="start_work_date"
                    type="text"
                    maxlength="10"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    data-val-required="Required"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    value="{{ $record->start_work_date??old('start_work_date') }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('start_work_date') }}</div>
            </div>
                   

            <div class="form-group col-sm-4">
            <label>{{ __('form.salary_amount') }} <span class="text-danger">*</span></label>
                <div class="input-group">
                <input
                    class="form-control number {{ $errors->first('salary_amount') ? 'is-invalid':'' }}"
                    name="salary_amount"
                    pattern="[0-9.]+"
                    type="text"
                    placeholder="293777.7"
                    maxlength="6"
                    value="{{ (old('salary_amount')??$record->salary_amount??0)?? 0 }}"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('form.khr') }}</span>
                    </div>
                    <div class="invalid-feedback">{{ $errors->first('salary_amount') }}</div>
                </div>                      
            </div>

            <div class="form-group col-sm-4">
                <label >{{ __('form.status') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('status') ? 'is-invalid':'' }}"  name="status">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($status as $st)
                        @isset ($record)
                            <option value="{{ $st->id }}" {{ $record->status == $st->id ? 'selected' :  '' }} >{{ $st->name_kh}}</option>
                        @else
                            <option value="{{ $st->id }}">{{ $st->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
            </div>
            <div class="form-group col-sm-12">
                <label >{{ __('form.address') }}</label>
                <textarea 
                    class="form-control {{ $errors->first('address') ? 'is-invalid':'' }}" 
                    type="text"
                    name="address"
                    placeholder="ភូមិ៧ សង្កាត់ទឹកល្អក់២ ខណ្ឌទួលគោក រាជធានីភ្នំពេញ"
                    maxlength="500"
                    rows="3"
                    >{{ $record->address??old('address') }}</textarea>                
                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
            </div>        
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a class="btn btn-warning float-left" href="{{ route('setting.master-data.staff.index') }}">
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