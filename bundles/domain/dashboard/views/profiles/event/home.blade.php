<div class="span17">
	{{-- title --}}
	{{ render('dashboard::profiles.event.common.title', ['event' => $event]) }}
	{{-- ***** --}}
	
	<div class="row station">
		<div class="span17">
			<div class="row event-profile">
				<div class="span17">

					{{-- left_panel --}}
					{{ render('dashboard::profiles.event.common.left_panel', ['event' => $event]) }}
					{{-- ********** --}}

					<div class="row event-hero">
						{{ render('dashboard::profiles.event.home.hero', ['event' => $event]) }}
					</div>

					<div class="row info-preview">
						{{ render('dashboard::profiles.event.home.info', ['event' => $event]) }}
					</div>

					<div class="row divider">
					</div>

					<div class="row media-preview">
						{{ render('dashboard::profiles.event.home.media', ['event' => $event]) }}
					</div>

					<div class="row picture-preview">
						{{ render('dashboard::profiles.event.home.albums', ['event' => $event]) }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Right Panel --}}
{{ render('dashboard::profiles.event.common.right_panel', ['event' => $event]) }}
{{-- *********** --}}