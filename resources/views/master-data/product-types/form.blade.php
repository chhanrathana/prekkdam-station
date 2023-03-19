<div class="row">    
    <div class="col-md-6 col-12">
        <label>Code <span class="text-danger">*</span></label>
        <input 
            type="text" 
            class="form-control {{ $errors->first('code') ? 'is-invalid':'' }}" 
            placeholder="P"
            name="code"
            maxlength="1"
            value="{{ old('code')??($item->code??'') }}">
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
</div>
