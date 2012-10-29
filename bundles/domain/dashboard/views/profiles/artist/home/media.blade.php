<div class="span5">
	<div class="heading">EVENTS<a class="all">(see all)</a></div>
	<div class="event-item">
		
		@if($event = $artist->closest_relevant_event)
			<div class="event-img">
				<img src="{{ $event->get_profile_photo_url('thumb') }}"
					 alt="{{ e($event->name) }}"
				/>
			</div>

			<div class="shadow"></div>
			
			<div class="event-detail">
				<div class="row event-name">
					<div class="span4">
						<a href="#">
							{{ e($event->name) }}
						</a>
					</div>
				</div>
				
				<div class="row date">
					@if($event->start_date === $event->end_date)
						<div class="span4">
							{{ $event->get_start_date('j M, D') }}
						</div>
					@else
						<div class="span4">
							{{ $event->get_start_date('j M D') }} - {{ $event->get_end_date('j M D') }}
						</div>
					@endif
				</div>
				<div class="row time">
					@if((int) $event->is_timed === 1)
						@if($event->start_time === $event->end_time)
							<div class="span4">
								{{ $event->get_start_time('g:ia') }} onwards
							</div>
						@else
							<div class="span4">
								{{ $event->get_start_time('g:ia') }} - {{ $event->get_end_time('g:ia') }}
							</div>
						@endif
					@else
						<div class="span4">Timing to be announced</div>
					@endif
				</div>
				<div class="row venue">
					@if(count($event->venues) > 0)
						<div class="span4">
							@foreach($event->venues as $i => $v)
								{{ e($v->name) }}, {{ e($v->city->name) }}
								@if(@$event->venues[$i+1])
									|
								@endif
							@endforeach
						</div>
					@endif
				</div>
			</div>
		@endif

	</div>
</div>
<div class="span5 offset1">
	<div class="heading">VIDEOS<a class="all">(see all)</a></div>
	<div class="video-thumb sec">
		@if($video = head($artist->featured_videos) or $video = head($artist->videos))
			<div class="video-image">
				<img src="{{ $video->thumb }}" alt="{{ e($video->name) }}"/>	
			</div>
			<div class="shadow"></div>

			<div class="video-play-btn"></div>
			<div class="add-q-btn"></div>
			
			<div class="video-detail">
				<div class="video-name">{{ e($video->name) }}</div>		
			</div>
		@endif
	</div>
</div>
<div class="span5 offset1">
	<div class="heading">SONGS<a class="all">(see all)</a></div>
	<div class="row songs-list">
		<div class="span5">
			
			@foreach($artist->featured_songs as $i=>$s)
				@if($i === 3)
					<?php break; ?>
				@endif
				<div class="row list-item">
					<div class="span1">
						<div class="song-play-btn"></div>
					</div>
					<div class="span1">
						<div class="add-q-btn">
							<a href="#" rel="tooltip" title="Add to Playlist"></a>
						</div>
					</div>

					<div class="span3">
						<div class="row song-detail">
							<div class="span3">
								<p class="song-name">{{ e($s->name) }}</p>
							</div>	
						</div>
					</div>
				</div>
			@endforeach
			
		</div>
	</div>
</div>