<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:title" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:description" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:image" content="https://w3crm.dexignzone.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>W3CRM Customer Relationship Management</title>
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
	
	<link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
	<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/jvmap/jquery-jvectormap.css') }}" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
	
	<!-- tagify-css -->
	<link href="{{ asset('vendor/tagify/dist/tagify.css') }}" rel="stylesheet">
	
	<!-- Style css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">	
</head>
<body data-typography="poppins" data-theme-version="light" data-layout="vertical" data-nav-headerbg="black" data-headerbg="color_1">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            @include('layouts.menu-header')    
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		<div class="chatbox">
			@include('layouts.chatbox')
		</div>
		<!--**********************************
            Chat box End
        ***********************************-->
		
		<!--**********************************
            Header start
        ***********************************-->
		<div class="header">
            @include('layouts.header')  
		</div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            @include('layouts.menu')    
        </div>		
        
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->	
			<div class="page-titles">
				@include('layouts.breadcrumb')  
			</div>
            
			<div class="container-fluid">
				<div class="row">
                    @yield('content')					
				</div>
			</div>
        </div>
		
        <!--**********************************
            Content body end
        ***********************************-->
		@include('includes.popup')
		
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
               <p>Copyright © Developed by <a href="https://khmer-app.com/" target="_blank">Khmer App</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->
		
        <!--**********************************
           Support ticket button end
        ***********************************-->
	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>
	
	<!-- Dashboard 1 -->
	<script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>
	<script src="{{ asset('vendor/draggable/draggable.js') }}"></script>
	
	
	<!-- tagify -->
	<script src="{{ asset('vendor/tagify/dist/tagify.js') }}"></script>
	 
	<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/js/jszip.min.js') }}"></script>
	<script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
   
	<!-- Apex Chart -->
	
	<script src="{{ asset('vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
	

	<!-- Vectormap -->
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('js/deznav-init.js') }}"></script>
</body>
</html>