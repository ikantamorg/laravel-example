<div class="grid-item" data-id="{{ $video->id }}">

	<div class="video-thumb">
		<div class="video-image">
			<img src="{{ $video->thumb }}" alt="video"/>
		</div>
		<div class="shadow"></div>
			
		<div class="video-play-btn"></div>
		<div class="add-q-btn"></div>
		
		<div class="video-detail">
			<div class="video-name">{{ e($video->name) }}</div>

			@if($video->artists and $artist = @$video->artists[0])
				<div class="artist-detail">
					<div class="artist-name pull-left">
						<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug) }}">{{ e($artist->name) }}</a>
						{{ render('dashboard::common.partials.artist-popup', ['artist' => $artist]) }}						
					</div>

					@if(($remaining = count($video->artists) - 1) > 0)
						<div class="more pull-right">
							<a>{{ $remaining }} more</a>
							<ul class="unstyled">
								<img src="{{ URL::to_asset('img/arrow.png') }}" alt="arrow" class="arrow"/>
								@foreach($video->artists as $a)
									<li>
										<img src="{{ $a->get_profile_photo_url('icon') }}" alt="{{ $a->name }}"/>
										<a href="#">{{ e($a->name) }}</a>
									</li>
								@endforeach
							</ul>	
						</div>
					@endif
				</div>	
			@endif
		</div>		

		<div class="socials">
			
			{{ render('dashboard::common.partials.video-fav-icon', ['video' => $video]) }}

			<div class="icon share pull-right">
				<a href="#"></a>
				<div class="popup2">
					<p>Share:</p>
					{{ HTML::image('img/arrow-mirror.png', 'arrow', [ 'class' => 'arrow']) }}
					<div class="share-icon facebook"><a></a></div>
					<div class="share-icon twitter"><a></a></div>
				</div>
			</div>
		</div>	
		
	</div>
</div>