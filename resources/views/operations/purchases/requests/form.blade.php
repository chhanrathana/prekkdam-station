<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.purchase_info') }}</strong>
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
                <label>{{ __('form.purchase_date') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('purchase_date') ? 'is-invalid':'' }}"
                    name="purchase_date"
                    type="text"
                    maxlength="10"
                    pattern="[0-9/]+"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    value="{{ (old('purchase_date')??$record->purchase_date??$currentDate)?? $currentDate }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('purchase_date') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label >{{ __('form.oil_type') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('oil_type_id') ? 'is-invalid':'' }}"  name="oil_type_id" id="oil_type_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($types as $type)
                        @isset ($record)
                            <option value="{{ $type->id }}" {{ $record->oil_type_id == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @else
                            <option value="{{ $type->id }}">{{ $type->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('oil_type_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label >{{ __('form.status') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('status_id') ? 'is-invalid':'' }}"  name="status_id" id="status_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($statuses as $status)
                        @isset ($record)
                            <option value="{{ $status->id }}" {{ $record->status_id == $status->id ? 'selected' :  '' }} >{{ $status->name_kh }}</option>
                        @else
                            <option value="{{ $status->id }}">{{ $status->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('status_id') }}</div>
            </div>
      
            <div class="form-group col-sm-4">
                <label>{{ __('form.qty') }} <span class="text-danger">*</span></label>
                <div class="input-group">
                <input
                    class="form-control number {{ $errors->first('qty_ton') ? 'is-invalid':'' }}"
                    name="qty_ton"
                    pattern="[0-9.]+"
                    type="text"
                    placeholder="10"
                    maxlength="2"
                    value="{{ (old('qty_ton')??$record->qty_ton??0)?? 0 }}"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('form.ton') }}</span>
                    </div>
                </div>
                <div class="invalid-feedback">{{ $errors->first('qty_ton') }}</div>
            </div>
           
            <div class="form-group col-sm-4">
                <label>{{ __('form.cost') }} <span class="text-danger">*</span></label>
                <div class="input-group">
                <input
                    class="form-control number {{ $errors->first('cost_usd') ? 'is-invalid':'' }}"
                    name="cost_usd"
                    pattern="[0-9.]+"
                    type="text"
                    placeholder="40000"
                    maxlength="4"
                    value="{{ (old('cost_usd')??$record->cost_usd??0)?? 0 }}"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('form.usd') }}</span>
                    </div>
                </div>
                <div class="invalid-feedback">{{ $errors->first('cost_usd') }}</div>
            </div>                                          
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">                
                <button class="btn btn-md btn-success float-right" type="submit">                    
                    {{ __('form.btn_save') }} <i class="fas fa-save"></i> 
                </button>
            </div>
        </div>
    </div>  
</div>