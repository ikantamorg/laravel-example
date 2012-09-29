@layout('crud::layout')

@section('content')

<div class="row">
	<div class="span24">
		{{ $table->render() }}
	</div>
</div>

@endsection