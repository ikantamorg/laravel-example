<div class="row fav-heading">
	<div class="span2"><div class="fav-image artists"></div></div>
	<div class="span8 offset1">
		<div class="fav-name">Favorite Artists</div>
		<div class="fav-count">{{ $num_artists }} Artists</div>
	</div>
</div>
				
<div class="row station">
	<div class="span12">
		<div class="row artists-list">
			<div class="span12">
				
				@foreach($artists as $artist)
					{{ render('dashboard::listings.artists.list-item', ['artist' => $artist]) }}
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