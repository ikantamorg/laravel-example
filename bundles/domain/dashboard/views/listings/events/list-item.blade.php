<div class="row list-item">
	<div class="span2">
		<img src="{{ $event->profile_photo ? $event->profile_photo->get_url('thumb') : '' }}" alt="{{ $event->name }}"/>
	</div>
	<div class="span7">
		<div class="row event-name">
			<div class="span7"><a href="#">{{ $event->name }}</a></div>
		</div>

		<div class="row artist-detail">
			<div class="span7">

				@foreach(range(0,2) as $r)
					@if($artist = @$event->artists[$r])

						<div class="artist-name">
							<a href="#">{{ $artist->name }}</a>
							<div class="popup">
								<img src="{{ URL::to_asset('img/arrow.png') }}" alt="arrow" class="arrow"/>
								<img src="{{ $artist->profile_photo ? $artist->profile_photo->get_url('thumb') : '' }}" alt="{{ $artist->name }}"/>
								<div class="popup-detail">
									<div class="popup-name">
										<a href="#">{{ $artist->name }}</a>
									</div>

									<div class="popup-facts">
										<a class="pull-left" href="#">{{ count($artist->songs) }} Songs</a>
										<a class="pull-left" href="#">{{ count($artist->videos) }} Videos</a>
									</div>

									<div class="socials">
										<div class="icon pull-left fav"><a href="#" rel="tooltip" title="Add to favorites"></a></div>
										<div class="icon facebook"><a href="#" rel="tooltip" title="Share on Facebook"></a></div>
										<div class="icon twitter"><a href="#" rel="tooltip" title="Share on Twitter"></a></div>
									</div>
								</div>	

							</div>
						</div>
						
					@endif
				@endforeach

				@if(count($event->artists) > 3 and ($remaining = (count($event->artists) - 3)) > 0)
					
					<div class="more">
						<a>+{{ $remaining }} more</a>
						<ul class="unstyled">
						@foreach(range(2, count($event->artists) - 1) as $r)
							@if($artist = @$artists[$r])
								<li>
									<img src="{{ $artist->profile_photo ? $artist->profile_photo->get_url('icon') : '' }}" alt="{{ $artist->name }}"/>
									<a href="#">{{ $artist->name }}</a>
								</li>
							@endif
						@endforeach
						</ul>
					</div>

				@endif
			</div>
		</div>
		
		<div class="row date">
			@if($event->start_date === $event->end_date)
				<div class="span7">{{ $event->get_start_date('j M, D') }}</div>
			@else
				<div class="span7">{{ $event->get_start_date('j M D') }} - {{ $event->get_end_date('j M D') }}</div>
			@endif
		</div>
		<div class="row time">
			<div class="span7">{{ $event->get_start_time('g:ia') }} - {{ $event->get_end_time('g:ia') }}</div>
		</div>
		<div class="row venue">
			@if(count($event->venues) === 1)
				<div class="span7">{{ $event->venue->name }}, {{ $event->venue->city->name }}</div>
			@elseif(count($event->venues) > 0)
				<div class="span7">
					{{ implode(' | ', array_map($venue_name_maker, $event->venues)) }}
				</div>
			@endif
		</div>
		
	</div>

	<div class="span1 offset2">
		<div class="socials">
			<div class="icon fav"><a href="#" rel="tooltip" title="Follow this Event"></a></div>
			<div class="icon share">
				<a href="#"></a>
				<div class="popup2">
					<p>Share:</p>
					<img src="{{ URL::to_asset('img/arrow-mirror.png') }}" alt="arrow" class="arrow"/>
					<div class="icon facebook"><a></a></div>
					<div class="icon twitter"><a></a></div>
				</div>
			</div>
		</div>		
	</div>
</div>