<div class="row left-pane">
	<div class="span4">
		<div class="row title"></div>

		<div class="row artist-tag left-item{{ (@$active_tagable->slug === 'artists') ? ' selected' : '' }}">
			<div class="span4">
				<a class="heading" href="{{ URL::to_action('dashboard::artists.listing') }}">ARTISTS</a>
				@if($selected_tags and @$active_tagable->slug === 'artists')
					<a class="clear" href="{{ URL::to_action('dashboard::artists.listing') }}">clear x</a>
				@endif

				@if(@$active_tagable->slug === 'artists')						
					<div class="tag-list">
						<ul class="unstyled">
							@foreach($displayed_tags as $t)
								<li>
									<a href="<?=URL::to('dashboard/artists/listing').'?'.$qs($t->slug)?>">
										{{ $t->name }}
									</a>
								</li>
							@endforeach							
						</ul>
					</div>
				@endif
			</div>	
		</div>
		<div class="row event-tag left-item{{ (@$active_tagable->slug === 'events') ? ' selected' : '' }}">
			<div class="span4">
				<a class="heading" href="{{ URL::to_action('dashboard::events.listing') }}">EVENTS</a>
				@if($selected_tags and @$active_tagable->slug === 'events')
					<a class="clear" href="{{ URL::to_action('dashboard::events.listing') }}">clear x</a>
				@endif

				@if(@$active_tagable->slug === 'events')
					<div class="tag-list">
						<ul class="unstyled">
							@foreach($displayed_tags as $t)
								<li>
									<a href="<?=URL::to('dashboard/events/listing').'?'
													. (in_array('timespan', $params) ? $qs($t->slug) : $qs($t->slug, 'timespan')) ?>"
									>
										{{ $t->name }}
									</a>
								</li>
							@endforeach							
						</ul>
					</div>
				@endif
			</div>	
		</div>

		<div class="row song-tag left-item{{ (@$active_tagable->slug === 'songs') ? ' selected' : '' }}">
			<div class="span4">
				<a class="heading" href="{{ URL::to_action('dashboard::songs.listing') }}">SONGS</a>
				@if($selected_tags and @$active_tagable->slug === 'songs')
					<a class="clear" href="{{ URL::to_action('dashboard::songs.listing') }}">clear x</a>
				@endif

				@if(@$active_tagable->slug === 'songs')
					<div class="tag-list">
						<ul class="unstyled">
							@foreach($displayed_tags as $t)
								<li>
									<a href="<?=URL::to('dashboard/songs/listing').'?'.$qs($t->slug)?>">
										{{ $t->name }}
									</a>
								</li>
							@endforeach							
						</ul>
					</div>
				@endif
			</div>	
		</div>
		
		<div class="row video-tag left-item{{ (@$active_tagable->slug === 'videos') ? ' selected' : '' }}">
			<div class="span4">
				<a class="heading" href="{{ URL::to_action('dashboard::videos.listing') }}">VIDEOS</a>
				@if($selected_tags and @$active_tagable->slug === 'videos')
					<a class="clear" href="{{ URL::to_action('dashboard::videos.listing') }}">clear x</a>
				@endif

				@if(@$active_tagable->slug === 'videos')
					<div class="tag-list">
						<ul class="unstyled">
							@foreach($displayed_tags as $t)
								<li>
									<a href="<?=URL::to('dashboard/videos/listing').'?'.$qs($t->slug)?>">
										{{ $t->name }}
									</a>
								</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>	
		</div>

		<?=Dashboard::widget('favorites_menu')?>
	</div>
</div>
