<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title',__('form.system_name'))</title>    
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/customs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/googleapis.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/croppie.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    @yield('css')
</head>

 <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-sidebar-brand d-lg-down-none" >
         
        <img class="c-sidebar-brand-full" height="75" src="{{ asset('img/logo.png') }}" alt="Loan"background: rgb(255 255 255)>
        <img class="c-sidebar-brand-minimized" height="75" src="{{ asset('img/logo.png') }}" alt="Loan">

      </div>
        @include('layouts.sidebar')
      <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>

    <div class="c-wrapper c-fixed-components">
      <header class="c-header c-header-light c-header-fixed c-header-with-subheader">

        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
          <svg class="c-icon c-icon-lg">
            <use xlink:href="/coreui/icons/sprites/free.svg#cil-menu"></use>
          </svg>
        </button>
        <a class="c-header-brand d-lg-none" href="#">
            <img width="50" height="50" src="{{ asset('img/logo.png') }}" alt="Loan">
        </a>

        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
          <svg class="c-icon c-icon-lg">
            <use xlink:href="/coreui/icons/sprites/free.svg#cil-menu"></use>
          </svg>
        </button>

        {{-- @include('layouts.fixedtop') --}}

        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="{{ auth()->user()->name ?? 'user' }}" id="userAvatar">
                    </div>
                </a>
                    @include('layouts.profilebar')
                </li>
        </ul>

        @include('layouts.breadcrumb')
      </header>
      <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
            <div class="fade-in">
                @include('includes.alert-info')
                @yield('content')
            </div>
          </div>
        </main>        
        <footer class="c-footer"><div class="text-center">@ 2023 {{ __('form.campany_name') }}</div></footer>
      </div>
    </div>

    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>	  
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>	  
    <script src="{{ asset('coreui/coreui/dist/js/coreui.bundle.min.js') }}"></script>
    
    <!--[if IE]><!-->
    <script src="{{ asset('coreui/icons/js/svgxuse.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
    
    <script src="{{ asset('js/customs.js') }}"></script>
    <script src="{{ asset('js/croppie.js') }}"></script> 
    @yield('script')
  </body>
</html>
