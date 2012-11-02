<div class="icon fav{{ $class }}">
	@if(! $is_favorited)
		<a
			href="{{ URL::to('dashboard/me/favorites/song/'. $song->id) }}"
			data-method="POST"
			data-stop-default="yes"
			rel="tooltip"
			title="Add to favorites"
		></a>
	@else
		<a
			href="{{ URL::to('dashboard/me/favorites/song/'.$song->id) }}"
			data-method="DELETE"
			data-stop-default="yes"
			rel="tooltip"
			title="Remove from favorites"
		></a>
	@endif
</div>