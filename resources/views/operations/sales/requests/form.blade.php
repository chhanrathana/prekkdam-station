<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.sale_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">

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
                <label>{{ __('form.sale_date') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('date') ? 'is-invalid':'' }}"
                    name="date"
                    type="text"
                    maxlength="10"
                    pattern="[0-9/]+"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    value="{{ (old('date')??$record->date??$currentDate)?? $currentDate }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('date') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label >{{ __('form.oil_type') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('oil_purchase_id') ? 'is-invalid':'' }}"  name="oil_purchase_id" id="oil_purchase_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($types as $type)
                        @isset ($record)
                            <option value="{{ $type->id }}" {{ $record->oil_purchase_id == $type->id ? 'selected' :  '' }} >{{ $type->code.' | '.$type->name_kh.' | '.number_format($type->remain_qty).' LITERS' }}</option>
                        @else
                            <option value="{{ $type->id }}">{{$type->code.' | '. $type->name_kh.' | '.number_format($type->remain_qty) .' LITERS' }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('oil_purchase_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label >{{ __('form.shift') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('work_shift_id') ? 'is-invalid':'' }}"  name="work_shift_id" id="work_shift_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($shifts as $shift)
                        @isset ($record)
                            <option value="{{ $shift->id }}" {{ $record->work_shift_id == $shift->id ? 'selected' :  '' }} >{{ $shift->name_kh }}</option>
                        @else
                            <option value="{{ $shift->id }}">{{ $shift->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('work_shift_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.old_capacitor') }} <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input
                    class="form-control number {{ $errors->first('old_motor_right') ? 'is-invalid':'' }}"
                    name="old_motor_right"
                    pattern="[0-9.]+"
                    type="text"
                    placeholder="293777.7"
                    maxlength="6"
                    value="{{ (old('old_motor_right')??$record->old_motor_right??0)?? 0 }}"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('form.right') }}</span>
                      </div>
                    <div class="invalid-feedback">{{ $errors->first('old_motor_right') }}</div>
                </div>                                                
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.new_capacitor') }} <span class="text-danger">*</span></label>
                <div class="input-group">
                <input
                    class="form-control number {{ $errors->first('new_motor_right') ? 'is-invalid':'' }}"
                    name="new_motor_right"
                    pattern="[0-9.]+"
                    type="text"
                    placeholder="293777.7"
                    maxlength="6"
                    value="{{ (old('new_motor_right')??$record->new_motor_right??0)?? 0 }}"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('form.right') }}</span>
                    </div>
                    <div class="invalid-feedback">{{ $errors->first('new_motor_right') }}</div>
                </div>                      
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.old_capacitor') }} <span class="text-danger">*</span></label>
                <div class="input-group">
                <input
                    class="form-control number {{ $errors->first('old_motor_left') ? 'is-invalid':'' }}"
                    name="old_motor_left"
                    pattern="[0-9.]+"
                    type="text"
                    placeholder="455.63"
                    maxlength="6"
                    value="{{ (old('old_motor_left')??$record->old_motor_left??0)?? 0 }}"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('form.left') }}</span>
                      </div>
                    <div class="invalid-feedback">{{ $errors->first('old_motor_left') }}</div>
                </div>                      
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.new_capacitor') }} <span class="text-danger">*</span></label>
                <div class="input-group">
                <input
                    class="form-control number {{ $errors->first('new_motor_left') ? 'is-invalid':'' }}"
                    name="new_motor_left"
                    pattern="[0-9.]+"
                    type="text"
                    placeholder="460.28"
                    maxlength="6"
                    value="{{ (old('new_motor_left')??$record->new_motor_left??0)?? 0 }}"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('form.left') }}</span>
                      </div>
                      <div class="invalid-feedback">{{ $errors->first('new_motor_left') }}</div>
                </div>
                
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.sale_price') }} <span class="text-danger">*</span></label>
                <div class="input-group">
                <input
                    class="form-control number {{ $errors->first('price') ? 'is-invalid':'' }}"
                    name="price"
                    pattern="[0-9.]+"
                    type="text"
                    placeholder="4300"
                    maxlength="4"
                    value="{{ (old('price')??$record->price??0)?? 0 }}"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('form.khr') }}</span>
                    </div>
                    <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                </div>
                
            </div>                                          
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <button class="btn btn-success float-right" type="submit">                    
                    {{ __('form.btn_save') }} <i class="fas fa-save"></i> 
                </button>
            </div>
        </div>
    </div>  
</div>