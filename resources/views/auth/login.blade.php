@extends('auth.auth-app')
@section('content')
<div class="justify-content-center">
    <div class="row">
        <div class="col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-sm-12"> 
            <div class="card-group">
                <div class="card p-3">
                    <div class="card-body">
                        <div class="text-center d-block d-sm-none">
                            <img class="img-fluid mx-auto rounded mb-2" style="max-height: 100px" src="{{ asset('img/brand.png') }}" alt="">
                        </div>
                        <h3 class="font-weight-bold text-center mb-4 text-nowrap">{{ __('form.system_name') }}</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <span class="material-icons-outlined">account_circle</span>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" placeholder="{{ __('form.account') }}" name="email" required autofocus>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <span class="material-icons-outlined">lock</span>
                                        </span>
                                    </div>
                                    <input class="form-control" type="password" placeholder="{{ __('form.password') }}" name="password" required>
                                </div>
                            </div>
                            
                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">                                            
                                    {{ __('form.login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    @if ($errors->any())
                    <div class="text-danger text-center"><strong>{{ $errors->first() }}</strong></div>
                    @endif
                </div>        
                <div class="card text-white bg-light py-5 d-md-down-none">
                    <div class="card-body text-center">
                        <img class="img-fluid mx-auto" style="max-height: 200px" src="{{ asset('img/brand.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@stop