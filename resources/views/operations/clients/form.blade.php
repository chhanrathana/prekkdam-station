<div class="card">
    <div class="card-header text-white bg-primary">
        <i class="fas fa-pen"></i>
        <strong>{{ __('form.client_info') }}</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" value="{{ $client->id??'' }}" name="client_id">
            
            <div class="form-group col-sm-4">
                <label >{{ __('form.type') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('client_type_id') ? 'is-invalid':'' }}"  name="client_type_id" id="client_type_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($types as $type)
                        @if ($client)
                            <option value="{{ $type->id }}" {{ $client->client_type_id == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @else
                            <option value="{{ $type->id }}" {{  old('client_type_id') == $type->id ? 'selected' :  '' }} >{{ $type->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('client_type_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.name_kh') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('name_kh') ? 'is-invalid':'' }}"
                    name="name_kh"
                    type="text"
                    placeholder="យិន ប៊ុនណា"
                    value="{{ $client->name_kh??old('name_kh') }}"
                    maxlength="50" >
                <div class="invalid-feedback">{{ $errors->first('name_kh') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.name_en') }} <span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('name_en') ? 'is-invalid':'' }}"
                    name="name_en"
                    type="text"
                    placeholder="YIN BUNNA"
                    value="{{ $client->name_en??old('name_en') }}"
                    maxlength="50">
                <div class="invalid-feedback">{{ $errors->first('name_en') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label >{{ __('form.sex') }} <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('sex') ? 'is-invalid':'' }}"  name="sex" id="sex">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($sexes as $sex)
                        @if ($client)
                            <option value="{{ $sex->id }}" {{ $client->sex == $sex->id ? 'selected' :  '' }} >{{ $sex->name_kh }}</option>
                        @else
                            <option value="{{ $sex->id }}" {{  old('sex') == $sex->id ? 'selected' :  '' }} >{{ $sex->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('sex') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.date_of_birth') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('date_of_birth') ? 'is-invalid':'' }}"
                    name="date_of_birth"
                    type="text"
                    maxlength="10"
                    pattern="[0-9/]+"
                    data-inputmask-alias="dd/mm/yyyy"
                    data-val="true"
                    data-val-required="Required"
                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                    value="{{ $client->date_of_birth??old('date_of_birth') }}"
                    >
                <div class="invalid-feedback">{{ $errors->first('date_of_birth') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label for="phone_number">{{ __('form.phone_number') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('phone_number') ? 'is-invalid':'' }}"
                    name="phone_number"
                    type="text"
                    pattern="\d*"
                    placeholder="0817623XX"
                    value="{{ $client->phone_number??old('phone_number') }}"
                    maxlength="50"
                    >
                <div class="invalid-feedback">{{ $errors->first('phone_number') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label for="id_card_no">{{ __('form.id_card_no') }}<span class="text-danger">*</span></label>
                <input
                    class="form-control {{ $errors->first('id_card_no') ? 'is-invalid':'' }}"
                    name="id_card_no"
                    type="text"
                    placeholder="061...."
                    pattern="\d*"
                    value="{{ $client->id_card_no??old('id_card_no') }}"
                    maxlength="15"
                    >
                <div class="invalid-feedback">{{ $errors->first('id_card_no') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label >{{ __('form.province') }}<span class="text-danger">*</span></label>
                <select class="form-control select2 {{ $errors->first('province_id') ? 'is-invalid':'' }}" name="province_id" id="province_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @foreach ($provinces as $province)
                        @if ($client)
                            <option value="{{ $province->id }}" {{ $client->village->commune->district->province->id == $province->id ? 'selected' :  '' }}>{{ $province->name_kh }}</option>
                        @else
                            <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' :  '' }}>{{ $province->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('province_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.district') }}<span class="text-danger">*</span></label>
                <select class="form-control select2 {{ $errors->first('district_id') ? 'is-invalid':'' }}" name="district_id" id="district_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                        @if ($client)
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ $client->village->commune->district->id == $district->id ? 'selected' :  '' }}>{{ $district->name_kh }}</option>
                            @endforeach
                        @endif
                </select>
                <div class="invalid-feedback">{{ $errors->first('district_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.commune') }} <span class="text-danger">*</span></label>
                <select class="form-control select2 {{ $errors->first('commune_id') ? 'is-invalid':'' }}" name="commune_id" id="commune_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                        @if ($client)
                            @foreach ($communes as $commune)
                                <option value="{{ $commune->id }}" {{ $client->village->commune->id == $commune->id ? 'selected' :  '' }}>{{ $commune->name_kh }}</option>
                            @endforeach
                        @endif

                </select>
                <div class="invalid-feedback">{{ $errors->first('commune_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>{{ __('form.village') }} <span class="text-danger">*</span></label>
                <select class="form-control select2 {{ $errors->first('village_id') ? 'is-invalid':'' }}" name="village_id" id="village_id">
                    <option value="" selected>[-- {{ __('form.select') }} --]</option>
                    @if ($client)
                        @foreach ($villages as $village)
                            <option value="{{ $village->id }}" {{ $client->village->id == $village->id ? 'selected' :  '' }}>{{ $village->name_kh }}</option>
                        @endforeach
                    @endif

                </select>
                <div class="invalid-feedback">{{ $errors->first('village_id') }}</div>
            </div>
        </div>
        @if($hadPhoto)        
            <div class="row">
                <div class="col"></div>
                <div class="col">                               
                    <div class="text-center max-auto">
                        <img src="{{ asset($client->photo??'img/avatar.jpeg') }}" class="img-thumbnail img-center" alt="avatar" draggable="false">                        
                    </div>                
                    <button type="button" class="btn btn-primary btn-sm btn-block" onclick="$('#file').click()">
                        <span class="material-icons-outlined">add_a_photo</span> {{ __('form.photo') }}
                    </button>
                    <input type="file" name="file" id="file" class="d-none" accept="image/*" />                
                </div>
                <div class="col"></div>
            </div>
        @endif
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <a class="btn btn-warning float-left" href="{{ route('operation.client.index')}}">
                    <i class="fas fa-arrow-left"></i> {{ __('form.btn_back') }}
                </a>

                <button class="btn btn-success float-right" type="submit">                    
                    <i class="fas fa-save"></i> {{ __('form.btn_save') }}
                </button>
            </div>
        </div>
    </div>
</div>