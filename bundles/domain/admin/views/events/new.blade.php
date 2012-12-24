@layout('admin::layout')

@section('title')
Events - Add Event
@endsection

@section('top-nav')

@include('admin::events._nav')

@endsection


@section('content')

{{ HTML::link(URL::to($base_url), '<< Back') }}
<hr>
{{ $form->render() }}

<script>
$(function () {
	$('.use-datepicker').datepicker({ format: 'dd-mm-yyyy' });
})
</script>

@endsection