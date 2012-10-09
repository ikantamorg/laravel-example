<div class="grid-item">

	<div class="video-thumb">
		<div class="video-image">
			<img src="{{ $video->thumb }}" alt="video"/>
		</div>
		<div class="shadow"></div>
			
		<div class="video-play-btn"></div>
		<div class="add-q-btn"></div>
		
		<div class="video-detail">
			<div class="video-name">{{ $video->name }}</div>

			@if($video->artists and $artist = @$video->artists[0])
				<div class="artist-detail">
					<div class="artist-name pull-left">
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

					@if(($remaining = count($video->artists) - 1) > 0)
						<div class="more pull-right">
							<a>{{ $remaining }} more</a>
							<ul class="unstyled">
								<img src="{{ URL::to_asset('img/arrow.png') }}" alt="arrow" class="arrow"/>
								@foreach($video->artists as $a)
									<li>
										<img src="{{ $a->profile_photo ? $a->profile_photo->get_url('thumb') : '' }}" alt="{{ $a->name }}"/>
										<a href="#">{{ $a->name }}</a>
									</li>
								@endforeach
							</ul>	
						</div>
					@endif
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
</div>