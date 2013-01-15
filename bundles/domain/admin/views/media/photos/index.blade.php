@layout('admin::layout')

@section('title')
Media - Photos
@endsection

@section('top-nav')

@endsection


@section('content')

<p>Total : {{ $total_records }}</p>
<p>Activated: {{ $activated_records }}</p>

<?php $searched_field = Session::get('searched_field'); Session::forget('searched_field'); ?>

@if($searched_field)
	<?=$listing->appends([$searched_field => Input::get($searched_field)])->links()?>
@else
	<?=$listing->links()?>
@endif

{{ HTML::link($base_url.'new', '+ Add a new Photo') }}

{{ $table->render() }}

@if($searched_field)
	<?=$listing->links()?>
@else
	<?=$listing->appends([$searched_field => Input::get($searched_field)])->links()?>
@endif

@endsection