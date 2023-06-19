<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.user_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">      
            <div class="form-group col-sm-4">
                <label >{{ __('form.type') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('user_type_id') ? 'is-invalid':'' }}"  name="user_type_id" id="user_type_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($types as $type)
                        @isset ($record)
                            <option value="{{ $type->id }}" {{ $record->user_type_id == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @else
                            <option value="{{ $type->id }}" {{  old('user_type_id') == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('user_type_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.name') }}</label>
                <input
                    class="form-control {{ $errors->first('name_kh') ? 'is-invalid':'' }}"
                    name="name_kh"
                    type="text"
                    placeholder="Men"
                    autocomplete="false"
                    value="{{ $record->name_kh??old('name_kh') }}"
                    maxlength="50" >
                <div class="invalid-feedback">{{ $errors->first('name_kh') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.account') }}</label>
                <input
                    class="form-control {{ $errors->first('email') ? 'is-invalid':'' }}"
                    name="email"
                    type="text"
                    autocomplete="false"
                    placeholder="BigMen"
                    value="{{ $record->email??old('email') }}"
                    maxlength="50" >
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.password') }}</label>
                <input
                    class="form-control {{ $errors->first('password') ? 'is-invalid':'' }}"
                    name="password"
                    type="password"
                    autocomplete="false"
                    placeholder="********"
                    value="{{ old('password') }}"
                    maxlength="50" >
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <a class="btn btn-warning float-left" href="{{ route('setting.user.index')}}">
                    <i class="fas fa-arrow-left"></i>  {{ __('form.btn_back') }}
                </a>

                <button class="btn btn-success float-right" type="submit">                    
                    <i class="fas fa-save"></i>  {{ __('form.btn_save') }}
                </button>
            </div>
        </div>
    </div>  
</div>