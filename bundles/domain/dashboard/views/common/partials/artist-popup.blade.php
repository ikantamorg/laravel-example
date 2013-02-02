<div class="popup">
	<img src="{{ URL::to_asset('img/arrow.png') }}" alt="arrow" class="arrow"/>
	<img src="{{ $artist->profile_photo ? $artist->profile_photo->get_url('thumb') : '' }}" alt="artist"/>
	
	<div class="popup-detail">
		<div class="popup-name">
			<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug) }}">{{ e($artist->name) }}</a>
		</div>

		<div class="popup-facts">
			<a class="pull-left" href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/songs') }}">
				{{ count($artist->songs) }} Songs
			</a>
			<a class="pull-left" href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/videos') }}">
				{{ count($artist->videos) }} Videos
			</a>
		</div>

		<div class="socials">
			<?=render('dashboard::common.partials.artist-fav-icon', [
				'artist' => $artist, 'class' => 'pull-left'
			])?>
			<div class="icon facebook"><a href="#" rel="tooltip" title="Share on Facebook"></a></div>
			<div class="icon twitter"><a href="#" rel="tooltip" title="Share on Twitter"></a></div>
		</div>
	</div>
</div>