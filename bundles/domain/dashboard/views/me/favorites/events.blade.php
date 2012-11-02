<div class="row fav-heading">
	<div class="span2"><div class="fav-image events"></div></div>
	<div class="span8 offset1">
		<div class="fav-name">Favorite Events</div>
		<div class="fav-count">{{ $num_events }} Events</div>
	</div>
</div>
				
<div class="row station">
	<div class="span12">
		<div class="row events-list">
			<div class="span12">
				
				@foreach($events as $event)
					{{ render('dashboard::listings.events.list-item', ['event' => $event])}}
				@endforeach				
				
				<div class="row list-item">
					<div class="span12">
						{{ $prev_link }}
						{{ $next_link }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>