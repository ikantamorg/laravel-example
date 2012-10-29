<div class="row list-item">
	<div class="span1"><div class="song-play-btn"></div></div>
	<div class="span1"><div class="add-q-btn"><a href="#" rel="tooltip" title="Add to Playlist"></a></div></div>

	<div class="span7">
		<div class="row song-detail">
			<div class="span7">
				<p class="song-name">{{ e($song->name) }}</p>
			</div>	
		</div>
		<div class="row artist-detail">
			<div class="span7">
				@foreach(range(0, 1) as $r)
					@if($artist = @$song->artists[$r])
						<div class="artist-name">
							<a href="#">{{ e($artist->name) }}</a>							
							<div class="popup">
								<img src="{{ URL::to_asset('img/arrow.png') }}" alt="arrow" class="arrow"/>
								<img src="{{ $artist->profile_photo ? $artist->profile_photo->get_url('thumb') : '' }}" alt="artist"/>
								
								<div class="popup-detail">
									<div class="popup-name">
										<a href="#">{{ e($artist->name) }}</a>
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

				@if(($remaining = (count($song->artists) - 2)) > 0)
					<div class="more">
						<a>{{ $remaining }} more</a>
						
						<ul class="unstyled">
							<img src="{{ URL::to_asset('img/arrow.png') }}" alt="arrow" class="arrow"/>

						@foreach(range(2, count($artists) - 1) as $r)
							@if($artist = $song->artists[$r])
								<li>
									<a href="#">{{ e($artist->name) }}</a>
								</li>
							@endif
						@endforeach
						</ul>	
					</div>
				@endif

			</div>	
		</div>
	</div>
	
	<div class="span2 offset1">
		<div class="socials">
			<div class="icon fav"><a href="#" rel="tooltip" title="Add to favorites"></a></div>
			<div class="icon share">
				<a href="#"></a>
				<div class="popup2">
					<p>Share:</p>
					<img src="{{ URL::to_asset('img/arrow-mirror.png') }}" alt="arrow" class="arrow" />
					<div class="icon facebook"><a></a></div>
					<div class="icon twitter"><a></a></div>
				</div>
			</div>
		</div>	
	</div>

</div>