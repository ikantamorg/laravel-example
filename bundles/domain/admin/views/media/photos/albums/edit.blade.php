@layout('admin::layout')

@section('title')
Media - Photo - Edit Album
@endsection

@section('top-nav')

@endsection


@section('content')

{{ HTML::link($base_url, '<< Back') }}

{{ $form->render() }}

<script>
$(function () {
	$('input[type=checkbox]').each(function (i, el) {
		var $el = $(el);
		$el.before($('<img>', {src: $el.data('src')}));
	});
});
</script>

@endsection