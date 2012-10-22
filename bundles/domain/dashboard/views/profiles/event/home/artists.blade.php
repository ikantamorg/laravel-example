<div class="span17">
	<div class="heading">ARTIST PERFORMING<a class="all">(see all)</a></div>
	<div class="row artist-list">
		@foreach($event->artists as $i=>$artist)
			@if($i === 3)
				<?php break; ?>
			@endif

			<div class="span5{{ $i > 0 ? ' offset1' : '' }}">
				<div class="artist-thumb">
					<a href="#"></a>
					<div class="artist-image">
						<img src="{{ $artist->get_profile_photo_url('thumb') }}">						
					</div>
					<div class="artist-name">
						{{ e($artist->name) }}
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>