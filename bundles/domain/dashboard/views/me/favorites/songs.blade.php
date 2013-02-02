<div class="row fav-heading">
	<div class="span2"><div class="fav-image songs"></div></div>
	<div class="span8 offset1">
		<div class="fav-name">Favorite Songs</div>
		<div class="fav-count">{{ $num_songs }} Songs</div>
	</div>
</div>
				
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