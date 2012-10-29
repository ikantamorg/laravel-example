@layout('dashboard::layouts.base')

@section('content')

<div class="row">
	<div class="span23 offset1">
		<div class="row" id="content">
			<div class="span23">
				<div class="row">
					<div class="span4">
						<?=Dashboard::widget('left_pane')?>
					</div>
					
					<div class="span12 offset1">

						{{ $body }}
						
					</div>
					
					<div class="span4 offset1">
						<?=Dashboard::widget('right_pane')?>						
					</div>

				</div>
			</div>
		</div>
	</div>
</div>


@endsection