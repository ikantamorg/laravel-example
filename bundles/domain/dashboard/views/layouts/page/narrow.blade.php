@layout('dashboard::layouts.base')

@section('content')

<div class="span12 offset1" id="bodyHolder">
	{{ $body }}
</div>

<div class="span4 offset1" id="rightPaneHolder">
	<?=Dashboard::widget('right_pane')?>						
</div>

@endsection