@include('dashboard::listings.artists.title')
				
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