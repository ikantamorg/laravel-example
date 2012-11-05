<div class="icon fav{{ $class }}">
	@if(! $is_favorited)
		<a 
			href="{{ URL::to('dashboard/me/favorites/artist/'.$artist->id) }}"
			data-method="POST"
			data-stop-default="yes"
			data-driver="httpVerbRequest"
			rel="tooltip"
			title="Follow"
		></a>
	@else
		<a
			href="{{ URL::to('dashboard/me/favorites/artist/'.$artist->id) }}"
			data-method='DELETE'
			data-stop-default="yes"
			data-driver="httpVerbRequest"
			rel="tooltip"
			title="Unollow"
		></a>
	@endif
</div>