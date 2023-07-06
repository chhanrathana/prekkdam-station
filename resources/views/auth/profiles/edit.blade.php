


@extends('layouts.app')
@section('title')
គណនី
@stop
@section('content')
<div class="card">
    <form action="{{ route('setting.profile.update',['id' => auth()->user()->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="card-header"> <strong>ប្តូរលេខសម្ងាត់</strong></div>

        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>គណនី</label>
                    <input
                        class="form-control {{ $errors->first('email') ? 'is-invalid':'' }}"
                        name="email"
                        type="email"
                        value="{{ $user->email }}"
                        disabled
                        maxlength="50" >
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                </div>
                <div class="form-group col-sm-6">
                    <label>ឈ្មោះ</label>
                    <input
                        class="form-control {{ $errors->first('name') ? 'is-invalid':'' }}"
                        name="name"
                        type="text"
                        placeholder="YIN BUNNA"
                        value="{{ old('name')??$user->name_kh }}"
                        maxlength="50">
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6">
                    <label>លេខសម្ងាត់</label>
                    <input
                        class="form-control {{ $errors->first('password') ? 'is-invalid':'' }}"
                        name="password"
                        type="password"
                        value="{{ old('password')??$user->password }}"
                        maxlength="50" >
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                </div>

                <div class="form-group col-sm-6">
                    <label>បញ្ជាក់លេខសម្ងាត់</label>
                    <input
                        class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid':'' }}"
                        name="password_confirmation"
                        type="password"
                        value="{{ old('password_confirmation')??$user->password }}"
                        maxlength="50">
                    <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-sm btn-success float-right" type="submit">
                <svg class="c-icon"><use xlink:href="/icons/svg/free.svg#cil-save"></use></svg>
            </button>
        </div>
</form>
</div>
@stop
