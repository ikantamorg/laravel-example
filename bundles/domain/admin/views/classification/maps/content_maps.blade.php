@layout('admin::layout')

@section('title')
Classification - Content Maps
@endsection

@section('top-nav')

{{ HTML::link($base_url, '<< Back') }}

@endsection


@section('content')

<h2>{{ $tag->name }} (Types: {{ implode(', ', array_map(function($t) { return $t->name; }, $tag->types)) }})</h2>

{{ Form::open($base_url.'content_maps/'.$tag->id, 'PUT') }}

@foreach($tag->content_maps as $slug => $map)
	
	<fieldset>
		<legend></legend>
		<div class="control-group">
			<label>{{ $tagable_name($slug) }}</label>
			{{ Form::select($slug.'[]', $content_options($slug), $content_value($map), ['multiple' => 'multiple']) }}
		</div>
	</fieldset>

@endforeach

{{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}

{{ Form::close() }}

@endsection