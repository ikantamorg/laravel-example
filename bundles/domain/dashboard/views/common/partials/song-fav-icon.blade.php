<div class="icon fav{{ $class }}">
	@if(! $is_favorited)
		<a
			href="{{ URL::to('dashboard/me/favorites/song/'. $song->id) }}"
			data-driver="favoritingDriver"
			rel="tooltip"
			title="Add to favorites"
			class="handledLink"
		></a>
	@else
		<a
			href="{{ URL::to('dashboard/me/favorites/song/'.$song->id) }}"
			data-driver = "favoritingDriver"
			rel="tooltip"
			title="Remove from favorites"
			class="handledLink"
		></a>
	@endif
</div>