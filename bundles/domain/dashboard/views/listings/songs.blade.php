@include('dashboard::listings.songs.title')
				
<div class="row station">
	<div class="span12">
		<div class="row songs-list">
			<div class="span12">
				
				@foreach($songs as $song)
					{{ render('dashboard::listings.songs.list-item', ['song' => $song]) }}
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