<div class="row">       
    
    <div class="col-md-6 col-12">
        <label>Code <span class="text-danger">*</span></label>
        <input 
            type="text" 
            class="form-control {{ $errors->first('code') ? 'is-invalid':'' }}" 
            placeholder="P00001" 
            name="code"
            maxlength="5"
            readonly
            value="{{ $code??($item->code??'') }}">
        <div class="invalid-feedback">{{ $errors->first('code') }}</div>
    </div>

    <div class="col-md-6 col-12">
        <label>Name Kh <span class="text-danger">*</span></label>
        <input 
            type="text" 
            class="form-control {{ $errors->first('name_kh') ? 'is-invalid':'' }}" 
            placeholder="ភេសជ្ជៈ....." 
            name="name_kh"
            maxlength="200"
            value="{{ old('name_kh')??($item->name_kh??'') }}">
        <div class="invalid-feedback">{{ $errors->first('name_kh') }}</div>
    </div>

    <div class="col-md-6 col-12">
        <label>Name En <span class="text-danger">*</span></label>
        <input 
            type="text"
            class="form-control {{ $errors->first('name_en') ? 'is-invalid':'' }}" 
            placeholder="DRINK ....." 
            name="name_en"
            maxlength="200"
            value="{{ old('name_en')??($item->name_en??'') }}">
        <div class="invalid-feedback">{{ $errors->first('name_en') }}</div>                            
    </div>
    
    <div class="col-md-6 col-12">
        <label>{{ __('word.sex') }} <span class="text-danger">*</span></label>
        <select class="form-select select-unit form-control {{ $errors->first('sex_id') ? 'is-invalid':'' }}" name="sex_id" data-placeholder="[-- ជ្រើសរើស --]">
            <option value=""></option>   
            @isset($sexes)
                @foreach ($sexes as $sex)
                    <option value="{{ $sex->id }}"
                        @if (old('sex_id') == $sex->id || (($item->sex_id??'') == $sex->id))
                            selected    
                        @endif
                    >{{ $sex->name_kh }}</option>
                @endforeach
            @endisset                                                           
        </select>
        <div class="invalid-feedback">{{ $errors->first('sex_id') }}</div>
    </div>    


    <div class="col-md-6 col-12">
        <label>{{ __('word.phone_number_01') }} <span class="text-danger">*</span></label>
        <input 
            type="text" 
            class="form-control number {{ $errors->first('phone_number_01') ? 'is-invalid':'' }}" 
            placeholder="00" 
            name="phone_number_01"
            maxlength="200"
            value="{{ old('phone_number_01')??($item->phone_number_01??'') }}">
        <div class="invalid-feedback">{{ $errors->first('phone_number_01') }}</div>
    </div>

    <div class="col-md-6 col-12">
        <label>{{ __('word.phone_number_02') }}</label>
        <input 
            type="text" 
            class="form-control number {{ $errors->first('phone_number_02') ? 'is-invalid':'' }}" 
            placeholder="00" 
            name="phone_number_02"
            maxlength="200"
            value="{{ old('phone_number_02')??($item->phone_number_02??'') }}">
        <div class="invalid-feedback">{{ $errors->first('phone_number_02') }}</div>
    </div>

    <div class="col-md-6 col-12">
        <label>{{ __('word.address') }}<span class="text-danger">*</span></label>
        <textarea 
            type="text" 
            name="address"
            maxlength="200"
            rows="3"
            class="form-control {{ $errors->first('address') ? 'is-invalid':'' }}" 
            aria-label="With textarea">{{ old('address')??($item->address??'') }}</textarea>
        <div class="invalid-feedback">{{ $errors->first('address') }}</div>
    </div>
   
</div>
