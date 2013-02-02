@if($artist->owned_photos or $artist->tagged_photos or $artist->photo_albums)
	<div class="span17">
		<div class="heading">PICTURES<a class="all">(see all)</a></div>
		<div class="row pictures-list sec">
			<div class="span17">
				@if($artist->owned_photos)
					<div class="album-thumb">
						<a  href="#" class="album-link"></a>
						<div class="shadow"></div>

						<div class="album-image">
							<img src="{{ head($artist->owned_photos)->get_url('thumb') }}"
								 alt="Owned Photos"/>												
						</div>
						<div class="album-name">Owned Photos</div>
						<div class="photo-count">{{ count($artist->owned_photos) }}</div>
					</div>
				@endif

				@if($artist->tagged_photos)
					<div class="album-thumb">
						<a  href="#" class="album-link"></a>
						<div class="shadow"></div>

						<div class="album-image">
							<img src="{{ head($artist->photos)->get_url('thumb') }}"
								 alt="Tagged Photos"/>												
						</div>
						<div class="album-name">Tagged Photos</div>
						<div class="photo-count">{{ count($artist->photos) }}</div>
					</div>
				@endif

				@foreach($artist->photo_albums as $album)
					@if($album->photos)
						<div class="album-thumb">
							<a  href="#" class="album-link"></a>
							<div class="shadow"></div>

							<div class="album-image">
								<img src="{{ head($album->photos)->get_url('thumb') }}"
									 alt="{{ $album->name }}"/>
							</div>
							<div class="album-name">{{ e($album->name) }}</div>
							<div class="photo-count">{{ count($album->photos) }} photos</div>
						</div>
					@endif
				@endforeach
				
			</div>			
		</div>
	</div>
@endif