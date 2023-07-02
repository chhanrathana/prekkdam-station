<div class="card">
    <div class="card-header text-white bg-primary"> <strong>ព័ត៌មានសន្សំ</strong></div>
    <div class="card-body">
        <div class="row">      
            <div class="form-group col-sm-4">
                <label >ប្រភេទ <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('deposit_type_id') ? 'is-invalid':'' }}"  name="deposit_type_id" id="deposit_type_id">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    
                    @foreach ($types as $type)
                        @isset ($deposit)
                            <option value="{{ $type->id }}" {{ $deposit->deposit_type_id == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @else
                            <option value="{{ $type->id }}" {{  old('deposit_type_id') == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('deposit_type_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>ចំនួនប្រាក់ <span class="text-danger">*</span></label>
                <input
                    class="form-control number {{ $errors->first('principal_amount') ? 'is-invalid':'' }}"
                    name="principal_amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    {{-- value="{{ $deposit->principal_amount??old('principal_amount') }}" --}}
                    value="10000000"
                    >
                <div class="invalid-feedback">{{ $errors->first('principal_amount') }}</div>
            </div>
            
            <div class="form-group col-sm-4">
                <label>ការប្រាក់ (%) <span class="text-danger">*</span></label>
                <input
                    class="form-control number {{ $errors->first('rate') ? 'is-invalid':'' }}"
                    name="rate"
                    type="text"
                    placeholder="0.7"
                    maxlength="6"
                    {{-- value="{{ $deposit->rate??0 }}" --}}
                    value="3"
                    >
                <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>ថ្ងៃខ្ចី <span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('registration_date') ? 'is-invalid':'' }}"
                    name="registration_date"
                    type="text"
                    maxlength="10"
                    pattern="[0-9/]+"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    {{-- value="{{ $deposit->registration_date??old('registration_date') }}" --}}
                    value="01/03/2023"
                    >
                <div class="invalid-feedback">{{ $errors->first('registration_date') }}</div>
            </div>
            
            <div class="form-group col-sm-4">
                <label>ថ្ងៃបង់ការដំបូង <span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('start_end_interest_date') ? 'is-invalid':'' }}"
                    name="start_end_interest_date"
                    type="text"
                    maxlength="10"
                    pattern="[0-9/]+"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    {{-- value="{{ $deposit->start_end_interest_date??old('start_end_interest_date') }}" --}}
                    value="10/03/2023"
                    >
                <div class="invalid-feedback">{{ $errors->first('start_end_interest_date') }}</div>
            </div>
            
            <div class="form-group col-sm-4">
                <label>រយៈពេល(ខែ) <span class="text-danger">*</span></label>
                <input
                    class="form-control term {{ $errors->first('term') ? 'is-invalid':'' }}"
                    name="term"
                    pattern="\d*"
                    type="text"
                    placeholder="12"
                    {{-- value="{{ $deposit->term??old('term') }}" --}}
                    value="12"
                    maxlength="2">
                <div class="invalid-feedback">{{ $errors->first('term') }}</div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <a class="btn btn-sm btn-warning float-left" href="{{ route('operation.deposit.index')}}">
                    <span class="material-icons-outlined">chevron_left</span>
                </a>

                <button class="btn btn-sm btn-success float-right" type="submit">
                    <span class="material-icons-outlined">save</span>
                </button>
            </div>
        </div>
    </div>
</div>