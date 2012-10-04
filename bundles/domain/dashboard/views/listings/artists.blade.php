@include('dashboard::listings.artists.title')
				
<div class="row station">
	<div class="span12">
		<div class="row artists-list">
			<div class="span12">
				
				@foreach($listing->results as $artist)
					{{ render('dashboard::listings.artists.list-item', ['artist' => $artist])}}
				@endforeach				
				
			</div>
		</div>
	</div>
</div>