<div class="span5">
	<div class="heading">MEMBERS</div>
	<div class="artist-detail sec">
		@if($artist->industry_memberships)
			@foreach($artist->get_industry_memberships('member') as $i => $im)
				@if($i === 4)
					<?php break; ?>
				@endif
				<div class="artist-name">	
					<a href="#" class="pull-left">{{ e($im->industry_member_profile->name) }}</a>
					<div></div>						
				</div>
				<p class="roles">({{ e($im->description) }})</p>
			@endforeach			
		@endif
	</div>

	@if(count($artist->industry_memberships) > 4)
		<a class="more" href="#">View more</a>
	@endif
</div>

<div class="span5 offset1">
	<div class="heading">MANAGEMENT</div>
	<div class="agent sec">
		
		@if($im = head($artist->get_industry_memberships('manager')))
			<div class="agent-name">	
				<a class="name" href="#">
					{{ e($im->industry_member_profile->name) }},
				</a>
				@if($industry_player = $im->connected_industry_player_for_tag('manager'))
					<a class="agency" href="#">
						{{ e($industry_player->name) }}
					</a>
				@endif
				
			</div>
			<div class="personal-detail contact"><span>T : </span> {{ e($im->industry_member_profile->phone) }}</div>
			<div class="personal-detail email"><span>E : </span> {{ e($im->industry_member_profile->email) }}</div>
		@else
			<div class="personal-detail contact"><span>T : </span> {{ e(@$im->industry_member_profile->phone) }}</div>
			<div class="personal-detail email"><span>E : </span> {{ e(@$im->industry_member_profile->email) }}</div>
		@endif
	</div>

	<div class="heading">BOOKING</div>
	<div class="agent sec">		
		@if($im = head($artist->get_industry_memberships('booking')))
			<div class="agent-name">	
				<a class="name" href="#">
					{{ e($im->industry_member_profile->name) }},
				</a>

				@if($industry_player = $im->connected_industry_player_for_tag('booking'))
					<a class="agency" href="#">
						{{ e($industry_player->name) }}
					</a>
				@endif
				
			</div>
			<div class="personal-detail contact"><span>T : </span> {{ e($im->industry_member_profile->phone) }}</div>
			<div class="personal-detail email"><span>E : </span> {{ e($im->industry_member_profile->email) }}</div>
		@else
			<div class="personal-detail contact"><span>T : </span> {{ e(@$im->industry_member_profile->phone) }}</div>
			<div class="personal-detail email"><span>E : </span> {{ e(@$im->industry_member_profile->email) }}</div>
		@endif

	</div>
</div>


<div class="span5 offset1">
	<div class="heading">ABOUT</div>
	<div class="about-preview sec">
		<p>
			{{ nl2p(e($artist->bio)) }}
		</p>			
	</div>
	<a class="more">Read more</a>
</div>