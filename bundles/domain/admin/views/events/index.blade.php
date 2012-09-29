@layout('admin::layout')

@section('title')
Events
@endsection

@section('top-nav')

@include('admin::events._nav')

@endsection


@section('content')

<?php $searched_field = Session::get('searched_field'); Session::forget('searched_field'); ?>

{{ HTML::link($base_url.'new', '+ Add a new Event') }}

@if($searched_field)
	<?=$listing->appends([$searched_field => Input::get($searched_field)])->links()?>
@else
	<?=$listing->links()?>
@endif

{{ $table->render() }}

@if($searched_field)
	<?=$listing->links()?>
@else
	<?=$listing->appends([$searched_field => Input::get($searched_field)])->links()?>
@endif

@endsection