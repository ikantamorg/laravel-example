<div class="row fav-heading">
	<div class="span2"><div class="fav-image videos"></div></div>
	<div class="span8 offset1">
		<div class="fav-name">Favorite Videos</div>
		<div class="fav-count">{{ $num_videos }} Videos</div>
	</div>
</div>
				
<div class="row station">
	<div class="span12">
		<div class="row videos-list">
			<div class="span12">
				
				@foreach($videos as $video)
					{{ render('dashboard::listings.videos.list-item', ['video' => $video]) }}
				@endforeach				
				
				<div class="row list-item">
					<div class="span12">
						{{ $prev_link }}
						{{ $next_link }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>