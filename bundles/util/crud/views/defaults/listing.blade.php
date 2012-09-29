@layout('crud::layout')

@section('content')

<div class="row">
	<div class="span10">
		{{ HTML::link(URL::to($base_url.'new'), '+ Add new') }}
	</div>
</div>
<div class="row">
	<div class="span24">
		{{ $table->render() }}
	</div>
</div>

@endsection