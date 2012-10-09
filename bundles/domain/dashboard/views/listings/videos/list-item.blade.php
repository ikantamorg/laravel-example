<div class="grid-item">

	<div class="video-thumb">
		<div class="video-image">
			{{ HTML::image('img/video-thumb.jpg', 'video') }}
		</div>
		<div class="shadow"></div>
			
		<div class="video-play-btn"></div>
		<div class="add-q-btn"></div>
		
		<div class="video-detail">
			<div class="video-name">KandisaKandisaKandisaKandisa</div>		
				
			<div class="artist-detail">
				<div class="artist-name pull-left">	
					<a href="{{ URL::to('artist-profile/info') }}">Indian OceanIndian OceanIndian OceanIndian Ocean</a>
					<div class="popup">
						{{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow']) }}
						{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
						<div class="popup-detail">
							<div class="popup-name"><a href="{{ URL::to('artist-profile/info') }}">Indian OceanIndian OceanIndian 		OceanIndian OceanIndian Ocean</a>
							</div>

							<div class="popup-facts">
								<a class="pull-left" href="{{ URL::to('artist-profile/songs') }}">22 Songs</a>
								<a class="pull-left" href="{{ URL::to('artist-profile/songs') }}">22 Songs</a>
							</div>

							<div class="socials">
								<div class="icon pull-left fav"><a href="#" rel="tooltip" title="Add to favorites"></a></div>
								<div class="icon facebook"><a href="#" rel="tooltip" title="Share on Facebook"></a></div>
								<div class="icon twitter"><a href="#" rel="tooltip" title="Share on Twitter"></a></div>
							</div>
						</div>	
					</div>
				</div>

				<div class="more pull-right">
					<a>+2 more</a>
					<ul class="unstyled">
						{{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow'])}}
						<li>
							{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
							<a href="{{ URL::to('artist-profile/info') }}">Indian Ocean</a>
						</li>

						<li>
							{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
							<a href="{{ URL::to('artist-profile/info') }}">Indian OceanOceanOceanOcean</a>
						</li>
					</ul>	
				</div>
			</div>	
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