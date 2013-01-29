@layout('dashboard::layouts.base')

@section('content')

<div class="span12 offset1">
	{{ $body }}
</div>

<div class="span4 offset1">
	<?=Dashboard::widget('right_pane')?>						
</div>

@endsection