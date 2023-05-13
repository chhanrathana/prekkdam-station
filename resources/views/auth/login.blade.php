@extends('auth.auth-app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="font-weight-bold text-center text-nowrap">ស្ថានីយ៍ឥន្ទនៈ SAVIMEX R5</h3>
                    <br/>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="material-icons-outlined">account_circle</span>                                
                                </span>
                            </div>
                            <input class="form-control" type="text" name="email" value="test"  required autofocus>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="material-icons-outlined">lock</span>
                            </span>
                            </div>
                            <input class="form-control" type="password" name="password" required value="FA4257->tPHZBW<P">
                        </div>
                        <div class="input-group mb-4 text-center">
                            <button class="btn btn-primary" type="submit">
                                {{-- <i class="fas fa-sign-in"></i> --}}
                                ចូលប្រព័ន្ធ
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
                    <img class="img-fluid mx-auto" src="{{ asset('img/brand.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    
</div>
@stop