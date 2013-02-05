<div class="row list-item" data-id="{{ $song->id }}">
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
							@if((int) $artist->active === 0)
								<a>{{ e($artist->name) }}</a>
							@else
								<a>{{ e($artist->name) }}</a>
								{{ render('dashboard::common.partials.artist-popup', ['artist' => $artist]) }}
							@endif
						</div>
					@endif
				@endforeach

				@if(($remaining = (count($song->artists) - 2)) > 0)
					<div class="more">
						<a>{{ $remaining }} more</a>
						
						<ul class="unstyled">
							<img src="{{ URL::to_asset('img/arrow.png') }}" alt="arrow" class="arrow"/>

						@foreach(range(2, count($song->artists) - 1) as $r)
							@if($artist = $song->artists[$r])
								<li>
									@if((int) $artist->active)
										<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug) }}" data-driver="pageChanger">{{ e($artist->name) }}</a>
									@else
										<a>{{ e($artist->name) }}</a>
									@endif
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
			
			{{ render('dashboard::common.partials.song-fav-icon', ['song' => $song]) }}

			<div class="icon share">
				<a href="#"></a>
				<div class="popup2">
					<p>Share:</p>
					<img src="{{ URL::to_asset('img/arrow-mirror.png') }}" alt="arrow" class="arrow" />
					<div class="share-icon facebook"><a></a></div>
					<div class="share-icon twitter"><a></a></div>
				</div>
			</div>
		</div>	
	</div>

</div>