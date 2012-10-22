<div class="span6 offset1">
	<div class="row display-pic sec">
		<div class="span6">
			<img src="{{ $event->get_profile_photo_url('thumb') }}" alt="{{ e($event->name) }}">
		</div>
	</div>

	<div class="row social-connect sec">
		<div class="span1 share-page facebook"><a></a></div>
		<div class="span1 share-page twitter"><a></a></div>
	</div>

	@if($page === 'info')
		<div class="row members sec">
			<div class="span6">
				<div class="heading">ARTIST PERFORMING</div>

				@foreach($event->artists as $a)
					<div class="artist-name main-content">
						<a href="#">{{ e($a->name) }}</a>
					</div>
				@endforeach

				<?php /*
					<div class="popup">
						{{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow']) }}
						{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
						<div class="popup-detail">
							<div class="popup-name"><a href="{{ URL::to('artist-profile/info') }}">Indian Ocean</a>
							</div>

							<div class="popup-facts">
								<a class="pull-left" href="{{ URL::to('artist-profile/songs') }}">22 Songs</a>
								<a class="pull-left" href="{{ URL::to('artist-profile/songs') }}">22 Songs</a>
							</div>

							<div class="socials">
								<div class="icon pull-left fav"><a href="#" rel="tooltip" title="Add to favorites"></a></div>
								<div class="icon facebook"><a href="#" rel="tooltip" title="Share on Facebook"></a></div>
								<div class="icon twitter"><a href="#" rel="tooltip" title="Share on Twitter"></a></div>
							</div>
						</div>	

					</div>
				*/ ?>
			</div>
		</div>
		<div class="row management sec">
			<div class="span6">
				<div class="heading">CONTACT INFO</div>
				<div class="agent main-content">
					
					<div class="p contact">
						<span>T : </span>{{-- What to put here --}}
					</div>
					<div class="p email">
						<span>W : </span>{{-- What to put here --}}
					</div>
				</div>
			</div>
		</div>
		<div class="row booking sec">
			<div class="span6">
				<div class="heading">BOOKING</div>
				<div class="agent main-content">
					<div class="agent-name">	
						<a class="name" href="#">
							{{-- What to put here --}}
						</a>

						<a class="agency" href="#">
							{{-- What to put here --}}
						</a>
						
					</div>
					<div class="p contact">
						<span>T : </span>{{-- What to put here --}}
					</div>
					<div class="p email">
						<span>E : </span>{{--What to put here --}}
					</div>
				</div>
			</div>
		</div>
	@endif
</div>