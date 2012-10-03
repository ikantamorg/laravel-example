
<div class="row list-item">
	<div class="span1"><div class="song-play-btn"></div></div>
	<div class="span1"><div class="add-q-btn"><a href="#" rel="tooltip" title="Add to Playlist"></a></div></div>

	<div class="span7">
		<div class="row song-detail">
			<div class="span7">
				<p class="song-name">Kandisa</p>
				<p class="time">(03:05)</p>
			</div>	
		</div>
		<div class="row artist-detail">
			<div class="span7">
				<div class="artist-name">	
					<a href="{{ URL::to('artist-profile/info') }}">Indian Ocean
					</a>
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

				<div class="more">
					<a>+3 more</a>
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

						<li>
							{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
							<a href="{{ URL::to('artist-profile/info') }}">Indian OceanOceanOceanOcean</a>
						</li>
					</ul>	
				</div>
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
					{{ HTML::image('img/arrow-mirror.png', 'arrow', [ 'class' => 'arrow']) }}
					<div class="icon facebook"><a></a></div>
					<div class="icon twitter"><a></a></div>
				</div>
			</div>
			<div class="icon buy"><a href="#" rel="tooltip" title="Buy this Song"></a></div>
		</div>	
	</div>

</div>
						


