@extends('layouts.app')
@section('title')
    បង្កើតសាខា
@stop
@section('content')

    <div class="card">
        <div class="card-header">
            <strong>បង្កើតសាខា</strong>
        </div>
        <form action="{{ route('setting.master-data.branch.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">                   
                    <div class="form-group col-sm-3">
                        <label>កូដ</label>
                        <input
                            class="form-control {{ $errors->first('code') ? 'is-invalid':'' }}"
                            name="code"
                            pattern="\d*"
                            type="text"
                            autocomplete="false"
                            placeholder="B001"
                            maxlength="10"
                            value="{{ old('code') }}"
                            maxlength="50" >
                        <div class="invalid-feedback">{{ $errors->first('code') }}</div>
                    </div>
                    
                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះ</label>
                        <input
                            class="form-control {{ $errors->first('name') ? 'is-invalid':'' }}"
                            name="name"
                            type="text"
                            placeholder="សាខាទី២"
                            autocomplete="false"
                            maxlength="250"
                            value="{{ old('name') }}"
                            maxlength="50" >
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    </div>
                  
                    <div class="form-group col-sm-5">
                        <label>ពិពណ៍នា</label>
                        <input
                            class="form-control {{ $errors->first('description') ? 'is-invalid':'' }}"
                            name="description"
                            type="text"
                            autocomplete="false"
                            placeholder="ភូមិ.....ឃុំ...."
                            maxlength="500"
                            value="{{ old('description') }}"
                            maxlength="50" >
                        <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-sm btn-success float-right" type="submit">
                            <span class="material-icons-outlined">save</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
</div>
@endsection
