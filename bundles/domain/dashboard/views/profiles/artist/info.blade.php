<div class="span17">
	{{-- title --}}
	{{ render('dashboard::profiles.artist._title', ['artist' => $artist]) }}
	{{-- ***** --}}
	
	<div class="row station">
		<div class="span17">
			<div class="row artist-profile">
				<div class="span17">

					{{-- left_panel --}}
					{{ render('dashboard::profiles.artist._left_panel', ['artist' => $artist]) }}

					<div class="row info-main">
						<div class="span7 offset2">
							<div class="row heading">ABOUT</div>
							<div class="main-content">
								{{ nl2p($artist->bio) }}
							</div>

						</div>

						<div class="span6 offset1">
							<div class="row display-pic sec">
								<div class="span6">
									<img src="{{ ($p = $artist->profile_photo) ? $p->get_url('thumb') : '' }}" 
										 alt="{{ $artist->name }}"/>
								</div>
							</div>
							<div class="row social-connect sec">
								<div class="span1 share-page facebook"><a></a></div>
								<div class="span1 share-page twitter"><a></a></div>
							</div>
							<div class="row members sec">
								<div class="span6">
									<div class="heading">MEMBERS</div>

									@foreach($artist->get_industry_memberships('member') as $i=>$im)
										<div class="artist-name main-content">	
											<a href="#">{{ $im->industry_member_profile->name }}</a>
											<p class="roles">{{ $im->description }}</p>
										</div>
									@endforeach
								</div>
							</div>
							<div class="row management sec">
								<div class="span6">
									<div class="heading">MANAGEMENT</div>
									@if($im = head($artist->get_industry_memberships('manager')))
										<div class="agent main-content">
											<div class="agent-name">	
												<a class="name" href="#">{{ $im->industry_member_profile->name }},</a>
												@if($industry_player = $im->connected_industry_player_for_tag('manager'))
													<a class="agency" href="#">{{ $industry_player->name }}</a>
												@endif
											</div>
											<div class="p contact"><span>T : </span> {{ $im->industry_member_profile->phone }}</div>
											<div class="p email"><span>E : </span> {{ $im->industry_member_profile->email }}</div>
										</div>
									@endif
								</div>
							</div>
							<div class="row booking sec">
								<div class="span6">
									<div class="heading">BOOKING</div>
									@if($im = head($artist->get_industry_memberships('booking')))
										<div class="agent main-content">
											<div class="agent-name">	
												<a class="name" href="#">{{ $im->industry_member_profile->name }},</a>
												@if($industry_player = $im->connected_industry_player_for_tag('booking'))
													<a class="agency" href="#">{{ $industry_player->name }}</a>
												@endif	
											</div>
											<div class="p contact"><span>T : </span> {{ $im->industry_member_profile->phone }}</div>
											<div class="p email"><span>E : </span> {{ $im->industry_member_profile->email }}</div>
										</div>
									@endif
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