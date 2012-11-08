<div class="icon fav{{ $class }}">
	@if(! $is_favorited)
		<a
			href="{{ URL::to('dashboard/me/favorites/video/'.$video->id) }}"
			data-method="POST"
			data-stop-default="yes"
			data-driver="httpVerbRequest"
			rel="tooltip"
			title="Add to favorites"
			class="handledLink"
		></a>
	@else
		<a
			href="{{ URL::to('dashboard/me/favorites/video/'.$video->id) }}"
			data-method="DELETE"
			data-stop-default="yes"
			data-driver="httpVerbRequest"
			rel="tooltip"
			title="Remove from favorites"
			class="handledLink"
		></a>
	@endif
</div>