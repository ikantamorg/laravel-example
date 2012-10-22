<div class="span17">
	<div class="sec">
		<div class="heading">PICTURES<a class="all">(see all)</a></div>
		<div class="row pictures-list">
			<div class="span16 offset1">
				@if($event->tagged_photos)
					<div class="album-thumb">
						<a  href="" class="album-link"></a>
						<div class="shadow"></div>

						<div class="album-image">
							<img src="{{ head($event->tagged_photos)->get_url('thumb') }}"
								 alt="Tagged Photos"/>							
						</div>
						<div class="album-name">Tagged Photos</div>
						<div class="photo-count">{{ count($event->tagged_photos) }} photos</div>
					</div>
				@endif
				@foreach($event->photo_albums as $i=>$album)
					@if($i === 2)
						<?php break; ?>
					@endif
					<div class="album-thumb">
						<a  href="{{ URL::to('artist-profile/album') }}" class="album-link"></a>
						<div class="shadow"></div>

						<div class="album-image">
							<img src="head($album->photos)->get_url('thumb')" alt="{{ $album->name }}">							
						</div>
						<div class="album-name">{{ $album->name }}</div>
						<div class="photo-count">{{ count($album->photos) }} photos</div>
					</div>
				@endforeach	
			</div>			
		</div>
	</div>	
</div>