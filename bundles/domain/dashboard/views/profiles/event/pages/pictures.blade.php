<div class="span14 offset2">
	<div class="row heading">PICTURES</div>
	<div class="row pictures-list">
		<div class="span14">
			@if($event->photos)
				<div class="album-thumb">
					<a href="#" class="album-link"></a>
					<div class="shadow"></div>

					<div class="album-image">
						<img src="{{ head($event->photos)->get_url('thumb') }}"
							 alt="Tagged Photos">					
					</div>
					<div class="album-name">Tagged Photos</div>
					<div class="photo-count">{{ count($event->photos) }} photos</div>
				</div>
			@endif

			@foreach($event->photo_albums as $album)
				<div class="album-thumb">
					<a href="#" class="album-link"></a>
					<div class="shadow"></div>

					<div class="album-image">
						<img src="{{ head($album->photos)->get_profile_photo_url('thumb') }}"
							 alt="Tagged Photos">					
					</div>
					<div class="album-name">{{ e($album->name) }}</div>
					<div class="photo-count">{{ count($album->photos) }} photos</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
