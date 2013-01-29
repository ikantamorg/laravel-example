@include('dashboard::listings.events.title')
				
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