@if($msg = Session::get('flash.success'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">x</button>
 		{{ $msg }}
	</div>
@endif

@if($msg = Session::get('flash.error'))
	<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">x</button>
 		{{ $msg }}
	</div>
@endif