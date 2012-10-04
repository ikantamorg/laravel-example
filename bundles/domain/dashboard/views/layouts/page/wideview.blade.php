@layout('dashboard::layouts.base')

@section('content')

<div class="row">
	<div class="span23 offset1">
		<div class="row" id="content">
			<div class="span23">
				<div class="row">

					<div class="span4">
						{{ render('dashboard::common.left-pane', ['role' => 'visitor']) }}
					</div>
					
					<div class="span18 offset1">
						<div class="row">
							<div class="span17">
								{{ $body }}
							</div>
							<div class="span1">
							</div>
						</div>						
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

@endsection