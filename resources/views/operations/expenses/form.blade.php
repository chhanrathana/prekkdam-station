<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.expense_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">
            
            <div class="form-group col-sm-4">
                <label >{{ __('form.type') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('expense_type_id') ? 'is-invalid':'' }}"  name="expense_type_id" id="expense_type_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($types as $type)
                        @if ($record)
                            <option value="{{ $type->id }}" {{ $record->expense_type_id == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @else
                            <option value="{{ $type->id }}" {{  old('expense_type_id') == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('expense_type_id') }}</div>
            </div>
           
            <div class="form-group col-sm-4">
                <label>{{ __('form.date') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('date') ? 'is-invalid':'' }}"
                    name="date"
                    type="text"
                    maxlength="10"
                    pattern="[0-9/]+"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    data-val-required="Required"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    value="{{ $record->date??old('date') }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('date') }}</div>
            </div>

              <div class="form-group col-sm-4">
                <label>{{ __('form.amount') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control number {{ $errors->first('amount') ? 'is-invalid':'' }}"
                    name="amount"
                    pattern="\d*"
                    type="text"
                    placeholder="10000000"
                    value="{{ $record->amount??old('amount') }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('amount') }}</div>
            </div>           
            <div class="form-group col-sm-4">
                <label>{{ __('form.description') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('description') ? 'is-invalid':'' }}"
                    name="description"
                    type="text"
                    placeholder="ឯកសារ"
                    value="{{ $record->description??old('description') }}"
                    maxlength="50" >
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
            </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                
                <button class="btn btn-success float-right" type="submit">                    
                    <i class="fas fa-save"></i> {{ __('form.btn_save') }}
                </button>
            </div>
        </div>
    </div>
</div>