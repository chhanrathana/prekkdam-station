@extends('layouts.app')
@section('title','គណនី')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
@endsection

@section('content')
    @include('includes.modal-upload-image', ['imageRoute'=>  route('profile.store') ])
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <strong>គណនី</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <img src="{{ asset('storage/'.$user->avatar) }}" class="img-thumbnail" alt="avatar" draggable="false" width="100%">
                    <h4 class="text-center mt-2 text-success"><b>{{ $user->name_kh }}</b></h4>
                    <h6 class="text-center mt-2 text-primary"><b>{{ $user->type->name_kh??'' }}</b></h6>
                    
                   <div class="text-center mt-2 mb-2">
                       <button type="button" class="btn btn-primary my-2" onclick="$('#file').click()">
                           <span class="material-icons-outlined">add_a_photo</span>
                           ប្តូររូបតំណាង
                       </button>
                       <input type="file" name="file" id="file" class="d-none" accept="image/*" />
                   </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <table class="table table-bordered table-striped table-hover" id ="table">
                        <tbody>
                        <tr>
                            <td><b>គណនី</b></td>
                            <td><b class="float-right">{{ $user->email ?? '' }}</b></td>
                        </tr>

                        <tr>
                            <td><b>ឈ្មោះ</b></td>
                            <td><b class="float-right">{{ $user->name_kh ?? '' }}</b></td>
                        </tr>
                        <tr>
                            <td><b>តួនាទីអ្នកប្រើប្រាស់</b></td>
                            <td><b class="float-right">{{ $user->type->name_kh??'' }}</b></td>
                        </tr>                       
                        </tbody>
                    </table>
                    
                    <a href="{{ route('profile.edit',['id' =>  auth()->user()->id]) }}" class="btn btn-outline-primary float-right" id="btn-crop-avatar">
                        <span class="material-icons-outlined">edit</span>
                        កែប្រែ
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="{{ asset('js/geolocation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/upload-image.js') }}"></script>
@endsection