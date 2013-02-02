@layout('admin::layout')

@section('title')
Industry-Players Register - Memberships
@endsection

@section('content')

<h2>{{ $register_entry->name }}, (Type: {{$register_entry->type}})</h2>

{{ Form::open($base_url.'memberships/'.$register_entry->id, 'PUT')}}

<fieldset>
	<legend>Memberships</legend>
	<div class="control-group">
		
	</div>
</fieldset>


{{ Form::close() }}

@endsection