<div class="span14 offset2">
	<div class="row heading">VIDEOS</div>
	<div class="row videos-list">
		<div class="span14">

			@foreach($artist->active_videos as $video)
				<div class="video-thumb">
					<div class="video-image">
						<img src="{{ $video->thumb }}" alt="{{ e($video->name) }}"/>
					</div>
					<div class="shadow"></div>
						
					<div class="video-play-btn"></div>
					<div class="add-q-btn"></div>
					
					<div class="video-detail">
						<div class="video-name">{{ e($video->name) }}</div>		
						@if(count($video->artists) > 1)
							<div class="artist-detail">
								<div class="more pull-right">
									<a>{{ count($video->artists) }} artists</a>
									<ul class="unstyled">
										{{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow'])}}
										@foreach($video->artists as $a)
											<li>
												<img src="{{ $a->get_profile_photo_url('icon') }}"
													 alt="{{ $a->name }}"/>
												<a href="#">
													{{ e($a->name) }}
												</a>
											</li>
										@endforeach
									</ul>	
								</div>
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
</div>


