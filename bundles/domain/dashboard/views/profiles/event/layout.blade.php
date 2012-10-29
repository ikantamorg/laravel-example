<div class="span17">
	{{-- title --}}
	{{ render('dashboard::profiles.event.common.title', ['event' => $event]) }}
	{{-- ***** --}}
	
	<div class="row station">
		<div class="span17">
			<div class="row event-profile">
				<div class="span17">

					{{-- left_panel --}}
					{{ render('dashboard::profiles.event.common.left_panel', ['event' => $event, 'page' => $page]) }}

					<div class="row {{ $page }}-main">
						{{ render("dashboard::profiles.event.pages.{$page}", ['event' => $event]) }}
						
						@if(! in_array($page, ['videos', 'pictures']) )
							{{ render('dashboard::profiles.event.layout.right-col', ['event' => $event, 'page' => $page]) }}
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


{{-- Right Panel --}}
{{ render('dashboard::profiles.event.common.right_panel', ['event' => $event]) }}
{{-- *********** --}}