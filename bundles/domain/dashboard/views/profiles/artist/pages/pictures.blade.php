<div class="span14 offset2">
	<div class="row heading">PICTURES</div>
	<div class="row pictures-list">
		<div class="span14">
			@if($artist->owned_photos)
				<div class="album-thumb">
					<a  href="#" class="album-link"></a>
					<div class="shadow"></div>

					<div class="album-image">
						<img src="{{ head($artist->owned_photos)->get_url('thumb') }}" alt="Owned Photos"/>
					</div>
					<div class="album-name">Owned Photos</div>
					<div class="photo-count">{{ count($artist->owned_photos) }} photos</div>
				</div>
			@endif

			@if($artist->photos)
				<div class="album-thumb">
					<a  href="#" class="album-link"></a>
					<div class="shadow"></div>

					<div class="album-image">
						<img src="{{ head($artist->owned_photos)->get_url('thumb') }}" alt="Owned Photos"/>
					</div>
					<div class="album-name">Tagged Photos</div>
					<div class="photo-count">{{ count($artist->photos) }} photos</div>
				</div>
			@endif
			@foreach($artist->photo_albums as $album)
				<div class="album-thumb">
					<a  href="#" class="album-link"></a>
					<div class="shadow"></div>

					<div class="album-image">
						<img src="{{ head($album->photos)->get_url('thumb') }}"
							 alt="{{ e($album->name) }}"/>						
					</div>
					<div class="album-name">{{ e($album->name) }}</div>
					<div class="photo-count">{{ count($album->photos) }} photos</div>
				</div>
			@endforeach
		</div>
	</div>
</div>