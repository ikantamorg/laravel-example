@layout('dashboard::layouts.base')

@section('content')

<div class="row" id="content">
	<div class="span22">
		<div class="row">

			{{ render('dashboard::common.left-pane', ['role' => 'visitor']) }}
			
			<div class="span12 offset1">

				<?php /*
				@include('pages.common.title.artist-profile')
				
				<div class="row station">
					<div class="span12">
						<div class="row artist-profile">
							<div class="span12">
								{{ render('partials.artist-profile.artist-profile-'. $partial, ['partial' => $partial]) }}
							</div>
						</div>
					</div>
				</div>
				*/?>
				
			</div>
			
			<?php /*@include('pages.common.right-pane')*/ ?>
		</div>
	</div>
</div>

@endsection