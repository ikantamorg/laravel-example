<div class="span17">
	{{-- title --}}
	{{ render('dashboard::profiles.event.common.title', ['event' => $event]) }}
	{{-- ***** --}}
	
	<div class="row station">
		<div class="span17">
			<div class="row event-profile">
				<div class="span17">

					{{-- left_panel --}}
					{{ render('dashboard::profiles.event.common.left_panel', ['event' => $event, 'page' => null]) }}
					{{-- ********** --}}

					<div class="row artist-hero">
						{{ render('dashboard::profiles.event.home.hero', ['event' => $event]) }}
					</div>

					<div class="row info-preview">
						{{ render('dashboard::profiles.event.home.info', ['event' => $event]) }}
					</div>

					<div class="row artist-preview">
						{{ render('dashboard::profiles.event.home.artists', ['event' => $event]) }}
					</div>

					<div class="row divider">
					</div>

					<div class="row media-preview">
						{{ render('dashboard::profiles.event.home.media', ['event' => $event]) }}
					</div>

					@if($event->photos)
						<div class="row picture-preview">
							{{ render('dashboard::profiles.event.home.pictures', ['event' => $event]) }}
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Right Panel --}}
{{ render('dashboard::profiles.event.common.right_panel', ['event' => $event]) }}
{{-- *********** --}}