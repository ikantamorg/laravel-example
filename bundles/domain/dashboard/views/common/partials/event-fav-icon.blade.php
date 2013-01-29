<div class="icon fav{{ $class }}">
	@if(! $is_favorited)
		<a
			href="{{ URL::to('dashboard/me/favorites/event/'.$event->id) }}"
			data-method="POST"
			data-stop-default="yes"
			data-driver="httpVerbRequest"
			rel="tooltip"
			title="Follow"
			class="handledLink"
		></a>
	@else
		<a
			href="{{ URL::to('dashboard/me/favorites/event/'.$event->id) }}"
			data-method="DELETE"
			data-stop-default="yes"
			data-driver="httpVerbRequest"
			rel="tooltip"
			title="Unfollow"
			class="handledLink"
		></a>
	@endif
</div>