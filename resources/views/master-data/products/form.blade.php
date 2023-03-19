<div class="row">       
    <div class="col-md-6 col-12">
        <label>Type <span class="text-danger">*</span></label>
        <select class="form-select select-product-type form-control {{ $errors->first('product_type_id') ? 'is-invalid':'' }}" name="product_type_id" data-placeholder="[-- ជ្រើសរើស --]">
            <option value=""></option>   
            @isset($productTypes)
                @foreach ($productTypes as $productType)
                    <option value="{{ $productType->id }}"
                        @if (old('product_type_id') == $productType->id || (($item->product_type_id??'') == $productType->id))
                            selected    
                        @endif
                    >{{ $productType->name_kh }}</option>
                @endforeach
            @endisset                                                           
        </select>
        <div class="invalid-feedback">{{ $errors->first('product_type_id') }}</div>
    </div>

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
        <label>{{ __('word.cost') }} <span class="text-danger">*</span></label>
        <input 
            type="text" 
            class="form-control number {{ $errors->first('cost') ? 'is-invalid':'' }}" 
            placeholder="00" 
            name="cost"
            maxlength="200"
            value="{{ old('cost')??($item->cost??'') }}">
        <div class="invalid-feedback">{{ $errors->first('cost') }}</div>
    </div>

    <div class="col-md-6 col-12">
        <label>{{ __('word.price') }} <span class="text-danger">*</span></label>
        <input 
            type="text" 
            class="form-control number {{ $errors->first('price') ? 'is-invalid':'' }}" 
            placeholder="00" 
            name="price"
            maxlength="200"
            value="{{ old('price')??($item->price??'') }}">
        <div class="invalid-feedback">{{ $errors->first('price') }}</div>
    </div>

    <div class="col-md-6 col-12">
        <label>{{ __('word.unit') }} <span class="text-danger">*</span></label>
        <select class="form-select select-unit form-control {{ $errors->first('unit_id') ? 'is-invalid':'' }}" name="unit_id" data-placeholder="[-- ជ្រើសរើស --]">
            <option value=""></option>   
            @isset($units)
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}"
                        @if (old('unit_id') == $unit->id || (($item->unit_id??'') == $unit->id))
                            selected    
                        @endif
                    >{{ $unit->code.'|'.$unit->name_kh }}</option>
                @endforeach
            @endisset                                                           
        </select>
        <div class="invalid-feedback">{{ $errors->first('unit_id') }}</div>
    </div>    
</div>
