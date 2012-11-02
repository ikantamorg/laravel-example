<div class="row favorite-tag left-item last">
	<div class="span4">
		<a class="heading">FAVORITES</a>

		@if($role ==='fan' or $role ==='industry-user')

			<div class="tag-list">
				<div class="row fav fav-song">
					<div class="span1 icon"></div>
					<div class="span2 name"><a href="{{ URL::to('dashboard/me/songs') }}">SONGS</a></div>
					<div class="span1 count">{{ $num_fav_songs }}</div>
				</div>
				<div class="row fav fav-artist">
					<div class="span1 icon"></div>
					<div class="span2 name"><a href="{{ URL::to('dashobard/me/artists') }}">ARTISTS</a></div>
					<div class="span1 count">{{ $num_fav_artists }}</div>
				</div>
				<div class="row fav fav-event">
					<div class="span1 icon"></div>
					<div class="span2 name"><a href="{{ URL::to('dashboard/me/events') }}">EVENTS</a></div>
					<div class="span1 count">{{ $num_fav_events }}</div>
				</div>
				<div class="row fav fav-video ">
					<div class="span1 icon"></div>
					<div class="span2 name"><a href="{{ URL::to('dashboard/me/videos') }}">VIDEOS</a></div>
					<div class="span1 count">{{ $num_fav_videos }}</div>
				</div>
			</div>

		@elseif($role ==='visitor')

			<div class="tag-list">
				<div class="signup">
					<div style=" height:10px; width:120px;"></div>
					<div class="signup-btn"></div>
					<div class="signup-notice"> to favorite and  follow artists, events and songs</div>
				</div>	
			</div>
		
		@endif

	</div>
</div>