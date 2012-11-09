<div class="row list-item" data-id="{{ $event->id }}">
	<div class="span3">
		<div class="event-img">
			<img src="{{ $event->get_profile_photo_url('thumb') }}" alt="{{ $event->name }}"/>
		</div>		
	</div>
	<div class="span7">
		<div class="row event-name">
			<div class="span7">
				<a href="{{ URL::to('dashboard/events/profile/'.$event->slug) }}">
					{{ e($event->name) }}
				</a>
			</div>
		</div>

		<div class="row artist-detail">
			<div class="span7">

				@foreach(range(0,3) as $r)
					@if($artist = @$event->artists[$r])

						<div class="artist-name">
							@if((int) $artist->active === 1)
								<a href="#">{{ e($artist->name) }}</a>
								{{ render('dashboard::common.partials.artist-popup', ['artist' => $artist]) }}
							@else
								<a>{{ e($artist->name) }}</a>
							@endif
						</div>
						
					@endif
				@endforeach

				@if(($remaining = (count($event->artists) - 4)) > 0)
					
					<div class="more">
						<a>+{{ $remaining }} more</a>
						<ul class="unstyled">
						@foreach(range(4, count($event->artists) - 1) as $r)
							@if($artist = @$event->artists[$r])
								<li>
									<img src="{{ $artist->get_profile_photo_url('icon') }}" alt="{{ e($artist->name) }}"/>
									@if((int) $artist->active === 1)
										<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug) }}">
											{{ e($artist->name) }}
										</a>
									@else
										<a>{{ e($artist->name) }}</a>
									@endif
								</li>
							@endif
						@endforeach
						</ul>
					</div>

				@endif
			</div>
		</div>
		
		<div class="row date">
			<div class="span7">
				@if($event->start_date === $event->end_date)
					{{ $event->get_start_date('j M, D') }}
				@else
					{{ $event->get_start_date('j M D') }} - {{ $event->get_end_date('j M D') }}
				@endif
			</div>
		</div>
		<div class="row time">
			<div class="span7">
				@if((int) $event->is_timed === 1)
					@if($event->start_time === $event->end_time)
						{{ $event->get_start_time('g:ia') }} onwards
					@else
						{{ $event->get_start_time('g:ia') }} - {{ $event->get_end_time('g:ia') }}
					@endif
				@else
					Timing to be announced
				@endif
			</div>
		</div>
		<div class="row venue">
			<div class="span7">
				@if(count($event->venues) > 0)
					@foreach($event->venues as $i => $v)
						{{ e($v->name) }}, {{ e($v->city->name) }}
						@if(@$event->venues[$i+1])
							|
						@endif
					@endforeach
				@endif
			</div>
		</div>
		
	</div>

	<div class="span1 offset1">
		<div class="socials">
			
			{{ render('dashboard::common.partials.event-fav-icon', ['event' => $event]) }}
			
			<div class="icon share">
				<a href="#"></a>
				<div class="popup2">
					<p>Share:</p>
					<img src="{{ URL::to_asset('img/arrow-mirror.png') }}" alt="arrow" class="arrow"/>
					<div class="share-icon facebook"><a></a></div>
					<div class="share-icon twitter"><a></a></div>
				</div>
			</div>
		</div>		
	</div>
</div>