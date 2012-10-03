<div class="row list-item">
	<div class="span2">
		{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
	</div>
	<div class="span7">
		<div class="row artist-name">
			<div class="span7">
				<a href="{{ URL::to('artist-profile/info') }}">Indian OceanIndian OceanIndian OceanIndian Ocean</a>
			</div>
		</div>
		<!--div class="row artist-news">
			<div class="span7">
				<p>Kandisa acquired cult status and propelled Indian Ocean into the status of one of India’s most original and creative bands.
				</p>
				<a href="{{ URL::to('artist-profile/info') }}">go to artist profile</a>
			</div>
		</div-->
		<div class="row artist-song">
			<div class="span1 offset1">
					<div class="play-button"></div>
			</div>
			<div class="span3">
				<p class="song-name">Kandisa</p>
				<p class="time">(02:50)</p>
			</div>
			<div class="span2"><a href="{{ URL::to('artist-profile/songs') }}" class="more">view more songs</a></div>
		</div>

		<div class="row artist-song">
			<div class="span1 offset1">
					<div class="play-button"></div>
			</div>
			<div class="span3">
				<p class="song-name">Maya maya re</p>
				<p class="time">(02:50)</p>
			</div>
			<div class="span2"><a href="{{ URL::to('artist-profile/songs') }}" class="more">view more songs</a></div>
		</div>
	</div>
	<div class="span1 offset2">
		<div class="socials">
			<div class="icon fav"><a href="#" rel="tooltip" title="Follow this artist"></a></div>
			<div class="icon share">
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
