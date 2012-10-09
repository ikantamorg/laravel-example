@include('dashboard::listings.videos.title')
				
<div class="row station">
	<div class="span12">
		<div class="row songs-list">
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