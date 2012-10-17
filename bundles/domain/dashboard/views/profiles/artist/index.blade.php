<div class="span17">
	{{-- title --}}
	@include('dashboard::profiles.artist._title')
	{{-- ***** --}}
	
	<div class="row station">
		<div class="span17">
			<div class="row artist-profile">
				<div class="span17">

					{{-- left_panel --}}
					@include('dashboard::profiles.artist._left_panel')
					{{-- ********** --}}

					<div class="row artist-hero">
						<div class="display-pic">
							<img src="{{ $artist->profile_photo ? $artist->profile_photo->get_url('display') : }}"/>
						</div>
						<div class="artist-profile-name">
							<div class="name">{{ $artist->name }}</div>
							<div class="genres"><?=implode('/ ', array_map(function ($g) { return $g->name; }, $artist->genres)?></div>
						</div> 
					</div>

					<div class="row info-preview">
						<div class="span5">
							<div class="sec">
								<div class="heading">MEMBERS</div>
								@if($artist->industry_memberships as $im)
									@foreach($artist->get_industry_memberships('member') as $i => $im)
										@if($i === 4)
											<?php break; ?>
										@endif
										<div class="artist-name main-content">	
											<a href="#" class="pull-left">{{ $im->industry_member_profile->name }}</a>
											<p class="roles">({{ $im->description }})</p>
										</div>
									@endforeach
									
									@if(count($artist->industry_memberships) > 4)
										<a class="more" href="#">View more</a>
									@endif
								@endif
							</div>
						</div>

						<div class="span5 offset1">
							<div class="sec">
								<div class="heading">MANAGEMENT</div>
								<div class="agent main-content">
									
									@if($im = head($artist->get_industry_memberships('manager')))
										<div class="agent-name">	
											<a class="name" href="#">Dev Bhatia,</a>
											<a class="agency" href="#">UnMute Agency</a>
										</div>
										<div class="p contact"><span>T : </span> +91 99999 99999</div>
										<div class="p email"><span>E : </span> agent at the rate agency.com</div>
									@else
									@endif

								</div>
								<div class="heading">BOOKING</div>
								<div class="agent main-content">
									
									@if($booking = head($artist->get_industry_memberships('booking')))
										<div class="agent-name">	
											<a class="name" href="#">Dev Bhatia,</a>

											<a class="agency" href="#">UnMute Agency</a>
											
										</div>
										<div class="p contact"><span>T : </span> +91 99999 99999</div>
										<div class="p email"><span>E : </span> agent at the rate agency.com</div>
									@else
									@endif

								</div>
							</div>
						</div>

						<div class="span5 offset1">
							<div class="sec">
								<div class="heading">ABOUT</div>
								<div class="preview-content">
									<p>
										{{ nl2br($artist->about) }}
									</p>

									<a class="more">Read more</a>
								</div>
							</div>
						</div>
					</div>

					<div class="row divider">
					</div>

					<div class="row media-preview">
						<div class="span5">
							<div class="sec">
								<div class="heading">EVENTS<a class="all">(see all)</a></div>
								<div class="event-item">
									
									@if($event = $artist->closest_relevant_event)
										<div class="event-img">
											<img src="{{ $event->profile_photo ? $event->profile_photo->get_url('thumb') : }}"
												 alt="{{ $event->name }}"
											/>
										</div>

										<div class="shadow"></div>
										
										<div class="event-detail">
											<div class="row event-name">
												<div class="span4">
													<a href="#">
														{{ $event->name }}
													</a>
												</div>
											</div>
											
											<div class="row date">
												@if($event->start_date === $event->end_date)
													<div class="span4">
														{{ $event->get_start_date('j M, D') }}
													</div>
												@else
													<div class="span4">
														{{ $event->get_start_date('j M D') }} - {{ $event->get_end_date('j M D') }}
													</div>
												@endif
											</div>
											<div class="row time">
												@if((int) $event->is_timed === 1)
													@if($event->start_time === $event->end_time)
														<div class="span4">
															{{ $event->get_start_time('g:ia') }} onwards
														</div>
													@else
														<div class="span4">
															{{ $event->get_start_time('g:ia') }} - {{ $event->get_end_time('g:ia') }}
														</div>
													@endif
												@else
													<div class="span4">Timing to be announced</div>
												@endif
											</div>
											<div class="row venue">
												@if(count($event->venues) > 0)
													<div class="span4">
														@foreach($event->venues as $i => $v)
															{{ $v->name }}, {{ $v->city->name }}
															@if(@$event->venues[$i+1])
																|
															@endif
														@endforeach
													</div>
												@endif
											</div>
										</div>
									@endif

								</div>
							</div>	
						</div>
						<div class="span5 offset1">
							<div class="sec">

								<div class="heading">VIDEOS<a class="all">(see all)</a></div>
								<div class="video-thumb">
									@if($video = $artist->random_video)
									<div class="video-image">
										{{ HTML::image('img/video-thumb.jpg', 'video') }}
									</div>
									<div class="shadow"></div>
										
									<div class="video-play-btn"></div>
									<div class="add-q-btn"></div>
									
									<div class="video-detail">
										<div class="video-name">KandisaKandisaKandisaKandisa</div>		
									</div>									
								</div>
							</div>
						</div>
						<div class="span5 offset1">
							<div class="sec">
								<div class="heading">SONGS<a class="all">(see all)</a></div>
								<div class="row songs-list">
									<div class="span5">
										
										@foreach(range(1, 3) as $r)
											
											<div class="row list-item">
												<div class="span1"><div class="song-play-btn"></div></div>
												<div class="span1"><div class="add-q-btn"><a href="#" rel="tooltip" title="Add to Playlist"></a></div></div>

												<div class="span3">
													<div class="row song-detail">
														<div class="span3">
															<p class="song-name">KandisaKandisaKandisa</p>
														</div>	
													</div>
												</div>
											</div>
										@endforeach
										
									</div>
								</div>
							
							</div>	
						</div>
					</div>

					<div class="row picture-preview">
						<div class="span17">
							<div class="sec">
								<div class="heading">PICTURES<a class="all">(see all)</a></div>
								<div class="row pictures-list">
									<div class="span16 offset1">
										@foreach(range(1, 5) as $r)
											<div class="album-thumb">
												<a  href="{{ URL::to('artist-profile/album') }}" class="album-link"></a>
												<div class="shadow"></div>

												<div class="album-image">
													{{ HTML::image('img/video-thumb.jpg', 'video') }}
												</div>
												<div class="album-name">Around the Globe in 80 Days and Night</div>
												<div class="photo-count">20 photos</div>
											</div>
										@endforeach	
									</div>			
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Right Panel --}}
@include('dashboard::profiles.artist._right_panel')
{{-- *********** --}}