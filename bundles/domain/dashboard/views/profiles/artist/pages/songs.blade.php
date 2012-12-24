<div class="span7 offset2">
	<div class="row heading">SONGS</div>
	
	<div class="row songs-list">
		<div class="span7">

			@foreach($artist->active_songs as $song)
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
							<div class="span7">
								<p class="song-name">{{ e($song->name) }}</p>
							</div>	
						</div>
						@if(count($song->artists) > 1)
							<div class="row artist-detail">
								<div class="span7">
									<div class="more">
										<a>{{ count($song->artists) }} artists</a>
										<ul class="unstyled">
											{{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow'])}}

											@foreach($song->artists as $a)
												<li>
													<img src="{{ $a->get_profile_photo_url('icon') }}"
														 alt="{{ e($a->name) }}"/>
													<a href="#">
														{{ e($a->name) }}
													</a>
												</li>
											@endforeach
										</ul>	
									</div>
								</div>	
							</div>
						@endif
					</div>
					
					<div class="span2">
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
						</div>	
					</div>

				</div>
			@endforeach									
		</div>
	</div>
</div>