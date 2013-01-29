<div class="span7 offset2">
	<div class="row heading">UPCOMING EVENTS</div>
	<div class="row events-list">
		<div class="span7">
			@foreach((array) $artist->upcoming_events as $event)
				<div class="row list-item">
					<div class="span3">
						<div class="event-img">
							<img src="{{ $event->get_profile_photo_url('thumb') }}"
								 alt="{{ e($event->name) }}"/>
						</div>
					</div>
					<div class="span4">
						<div class="row event-name">
							<div class="span3">
								<a href="{{ URL::to('event-profile/info') }}">
									{{ e($event->name) }}
								</a>
							</div>
						</div>
						
						<div class="row date">
							<div class="span4">
								@if($event->start_date === $event->end_date)
									{{ $event->get_start_date('j M, D') }}											
								@else
									{{ $event->get_start_date('j M D') }} - {{ $event->get_end_date('j M D') }}	
								@endif
							</div>
						</div>
						<div class="row time">
							<div class="span4">
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
							<div class="span4">
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

						<div class="row socials">
							<div class="icon fav"><a href="#" rel="tooltip" title="Follow this Event"></a></div>
							<div class="icon share">
								<a href="#"></a>
								<div class="popup2">
									<p>Share:</p>
									<img src="img/arrow-mirror.png" alt="arrow" class="arrow"/>
									<div class="icon facebook"><a></a></div>
									<div class="icon twitter"><a></a></div>
								</div>
							</div>
						</div>
					</div>											
				</div>
			@endforeach									
		</div>
	</div>

	<div class="row heading">PAST EVENTS</div>
	<div class="row events-list">
		<div class="span7">
			@foreach((array) $artist->past_events as $event)
				<div class="row list-item past">
					<div class="span3">
						<div class="event-img">
							<img src="{{ $event->get_profile_photo_url('thumb') }}"
								 alt="{{ e($event->name) }}"/>
						</div>
					</div>
					<div class="span4">
						<div class="row event-name">
							<div class="span3">
								<a href="{{ URL::to('event-profile/info') }}">
									{{ e($event->name) }}
								</a>
							</div>
						</div>
						
						<div class="row date">
							<div class="span4">
								@if($event->start_date === $event->end_date)
									{{ $event->get_start_date('j M, D') }}											
								@else
									{{ $event->get_start_date('j M D') }} - {{ $event->get_end_date('j M D') }}	
								@endif
							</div>
						</div>
						<div class="row time">
							<div class="span4">
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
							<div class="span4">
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

						<div class="row socials">
							<div class="icon fav"><a href="#" rel="tooltip" title="Follow this Event"></a></div>
							<div class="icon share">
								<a href="#"></a>
								<div class="popup2">
									<p>Share:</p>
									<img src="img/arrow-mirror.png" alt="arrow" class="arrow"/>
									<div class="icon facebook"><a></a></div>
									<div class="icon twitter"><a></a></div>
								</div>
							</div>
						</div>
					</div>											
				</div>
			@endforeach									
		</div>
	</div>
</div>