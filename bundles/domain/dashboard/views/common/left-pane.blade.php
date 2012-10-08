<div class="row left-pane">
	<div class="span4">
		<div class="row title"></div>

		<div class="row artist-tag left-item">
			<div class="span4">
				<a class="heading" href="{{ URL::to_action('dashboard::artists.listing') }}">ARTISTS</a>
				<a class="clear">clear x</a>

				<div class="tag-list">
					<ul class="unstyled">
						<li><a>sufi</a></li>
						<li><a>fusion</a></li>
						<li><a>pop</a></li>
						<li><a>remix</a></li>
						<li><a>sad</a></li>
						<li><a>country</a></li>
						<li><a>bollywood</a></li>
						<li><a>jazz</a></li>
						<li><a>dance</a></li>
					</ul>
				</div>
			</div>	
		</div>
		<div class="row event-tag left-item">
			<div class="span4">
				<a class="heading" href="{{ URL::to_action('dashboard::events.listing') }}">EVENTS</a>
				<a class="clear">clear x</a>

				<div class="tag-list">
					<ul class="unstyled">
						<li><a>sufi</a></li>
						<li><a>fusion</a></li>
						<li><a>pop</a></li>
						<li><a>remix</a></li>
						<li><a>sad</a></li>
						<li><a>country</a></li>
						<li><a>bollywood</a></li>
						<li><a>jazz</a></li>
						<li><a>dance</a></li>
					</ul>
				</div>
			</div>	
		</div>
		<div class="row song-tag left-item">
			<div class="span4">
				<a class="heading" href="{{ URL::to_action('dashboard::songs.listing') }}">SONGS</a>
				<a class="clear">clear x</a>

				<div class="tag-list">
					<ul class="unstyled">
						<li><a>sufi</a></li>
						<li><a>fusion</a></li>
						<li><a>pop</a></li>
						<li><a>remix</a></li>
						<li><a>sad</a></li>
						<li><a>country</a></li>
						<li><a>bollywood</a></li>
						<li><a>jazz</a></li>
						<li><a>dance</a></li>
					</ul>
				</div>
			</div>	
		</div>
		
		<div class="row video-tag left-item">
			<div class="span4">
				<a class="heading" href="{{ URL::to_action('dashboard::videos.listing') }}">VIDEOS</a>
				<a class="clear">clear x</a>

				<div class="tag-list">
					<ul class="unstyled">
						<li><a>sufi</a></li>
						<li><a>fusion</a></li>
						<li><a>pop</a></li>
						<li><a>remix</a></li>
						<li><a>sad</a></li>
						<li><a>country</a></li>
						<li><a>bollywood</a></li>
						<li><a>jazz</a></li>
						<li><a>dance</a></li>
					</ul>
				</div>
			</div>	
		</div>
		<div class="row favorite-tag left-item last selected">
			<div class="span4">
				<a class="heading">FAVORITES</a>

				@if($role ==='fan' or $role ==='industry-user')

					<div class="tag-list">
						<div class="row fav fav-song">
							<div class="span1 icon"></div>
							<div class="span2 name"><a href="{{ URL::to('songs') }}">SONGS</a></div>
							<div class="span1 count">12</div>
						</div>
						<div class="row fav fav-artist">
							<div class="span1 icon"></div>
							<div class="span2 name"><a href="{{ URL::to('artists') }}">ARTISTS</a></div>
							<div class="span1 count">12</div>
						</div>
						<div class="row fav fav-event">
							<div class="span1 icon"></div>
							<div class="span2 name"><a href="{{ URL::to('events') }}">EVENTS</a></div>
							<div class="span1 count">12</div>
						</div>
						<div class="row fav fav-video ">
							<div class="span1 icon"></div>
							<div class="span2 name"><a href="{{ URL::to('videos') }}">VIDEOS</a></div>
							<div class="span1 count">12</div>
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
	</div>
</div>
