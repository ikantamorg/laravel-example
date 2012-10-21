<div class="span6 offset1">
	<div class="row display-pic sec">
		<div class="span6">
			<img src="{{ $artist->get_profile_photo_url('thumb') }}" 
				 alt="{{ e($artist->name) }}"/>
		</div>
	</div>
	<div class="row social-connect sec">
		<div class="span1 share-page facebook"><a></a></div>
		<div class="span1 share-page twitter"><a></a></div>
	</div>

	@if($page === 'info')
		<div class="row members sec">
			<div class="span6">
				<div class="heading">MEMBERS</div>

				@foreach($artist->get_industry_memberships('member') as $i=>$im)
					<div class="artist-name main-content">	
						<a href="#">{{ e($im->industry_member_profile->name) }}</a>
						<p class="roles">{{ e($im->description) }}</p>
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
							<a class="name" href="#">{{ e($im->industry_member_profile->name) }},</a>
							@if($industry_player = $im->connected_industry_player_for_tag('manager'))
								<a class="agency" href="#">{{ e($industry_player->name) }}</a>
							@endif
						</div>
						<div class="p contact"><span>T : </span> {{ e($im->industry_member_profile->phone) }}</div>
						<div class="p email"><span>E : </span> {{ e($im->industry_member_profile->email) }}</div>
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
							<a class="name" href="#">{{ e($im->industry_member_profile->name) }},</a>
							@if($industry_player = $im->connected_industry_player_for_tag('booking'))
								<a class="agency" href="#">{{ e($industry_player->name) }}</a>
							@endif	
						</div>
						<div class="p contact"><span>T : </span> {{ e($im->industry_member_profile->phone) }}</div>
						<div class="p email"><span>E : </span> {{ e($im->industry_member_profile->email) }}</div>
					</div>
				@endif
			</div>
		</div>
	@endif
</div>