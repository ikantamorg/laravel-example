<div class="row list-item" data-id="{{ $artist->id }}">
	<div class="span2">
		<div class="artist-image">
			<img src="{{ $artist->get_profile_photo_url('thumb') }}" alt="{{ $artist->name }}"/>
		</div>
	</div>
	<div class="span7">
		<div class="row artist-name">
			<div class="span7">
				<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug) }}" data-driver="pageChanger">{{ $artist->name }}</a>
			</div>
		</div>
		
		@foreach($artist->featured_songs as $i => $song)
			@if($i === 2)
				<?php break; ?>
			@endif
			<div class="row artist-song" data-id="{{ $song->id }}">
				<div class="span1 offset1">
					<div class="play-button"></div>
				</div>
				<div class="span3">
					<p class="song-name">{{ $song->name }}</p>
				</div>
				<div class="span2">
					<a href="{{ URL::to('dashboard/artists/profile/'.$artist->slug.'/songs') }}" data-driver="pageChanger" class="more">view more songs</a>
				</div>
			</div>
		@endforeach
	</div>
	<div class="span1 offset2">
		<div class="socials">
			
			{{ render('dashboard::common.partials.artist-fav-icon', ['artist' => $artist]) }}
			
			<div class="icon share">
				<a href="#"></a>
				<div class="popup2">
					<p>Share:</p>
					{{ HTML::image('img/arrow-mirror.png', 'arrow', [ 'class' => 'arrow']) }}
					<div class="share-icon facebook"><a></a></div>
					<div class="share-icon twitter"><a></a></div>
				</div>
			</div>
		</div>	
	</div>
</div>
