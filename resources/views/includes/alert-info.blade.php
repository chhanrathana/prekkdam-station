 @if ($message = session()->get('error'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Error !</strong> {{ $message }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif
@if( $message = session()->get('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Success !</strong> {{ $message }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif