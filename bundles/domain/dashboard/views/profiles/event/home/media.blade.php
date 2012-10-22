<div class="span17">
	<div class="sec">

		<div class="heading">VIDEOS<a class="all">(see all)</a></div>

		@foreach($event->videos as $i => $video)
			@if($i === 3)
				<?php break; ?>
			@endif

			<div class="video-thumb">
				<div class="video-image">
					<img src="{{ $video->thumb }}" alt="{{ e($video->name) }}">					
				</div>
				<div class="shadow"></div>
					
				<div class="video-play-btn"></div>
				<div class="add-q-btn"></div>
				
				<div class="video-detail">
					<div class="video-name">{{ e($video->name) }}</div>

					@if($artists = $video->artists)
						<div class="more pull-right">
								<a>{{ count($artists) }} {{ (count($artists) == 1) ? 'artist' : 'artists' }}</a>
								<ul class="unstyled">
									{{ HTML::image('img/arrow.png', 'arrow', ['class' => 'arrow']) }}
									@foreach($artists as $a)
										<li>
											<img src="{{ $a->get_profile_photo_url('icon') }}" alt="{{ e($a->name) }}"/>
											<a href="{{ URL::to('artist-profile/info') }}">{{ e($a->name) }}</a>
										</li>

									@endforeach
								</ul>	
						</div>
					@endif
				</div>

				<div class="socials">
					<div class="icon fav"><a href="#" rel="tooltip" title="Add to favorites"></a></div>
					<div class="icon share pull-right">
						<a href="#"></a>
						<div class="popup2">
							<p>Share:</p>
							{{ HTML::image('img/arrow-mirror.png', 'arrow', [ 'class' => 'arrow']) }}
							<div class="icon facebook"><a></a></div>
							<div class="icon twitter"><a></a></div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>