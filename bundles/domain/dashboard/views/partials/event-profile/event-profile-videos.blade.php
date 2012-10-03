<div class="row tabs">
	<div class="span12">
		<ul class="unstyled">
			<li class="span2 {{ $partial === 'info' ? 'active' : '' }}"><a href="{{ URL::to('event-profile/info') }}">INFO</a></li>
			<li class="span2 {{ $partial === 'songs' ? 'active' : '' }}"><a href="{{ URL::to('event-profile/songs') }}">SONGS</a></li>
			<li class="span2 {{ $partial === 'videos' ? 'active' : '' }}"><a href="{{ URL::to('event-profile/videos') }}">VIDEOS</a></li>
		</ul>	
	</div>			
</div> 


<div class="row">
	<div class="span6">
		<div class="row pictures sec">
			<div class="span6">
				<div class="display">
					{{ HTML::image('img/display.jpg', 'display') }}
				</div>
				<div class="thumbs">
					<div class="row">
						{{ HTML::image('img/artist-thumb.jpg', 'artist', [ 'class' => 'span1']) }}
						{{ HTML::image('img/artist-thumb.jpg', 'artist', [ 'class' => 'span1']) }}
						{{ HTML::image('img/artist-thumb.jpg', 'artist', [ 'class' => 'span1']) }}
						{{ HTML::image('img/artist-thumb.jpg', 'artist', [ 'class' => 'span1']) }}
						{{ HTML::image('img/artist-thumb.jpg', 'artist', [ 'class' => 'span1']) }}
						{{ HTML::image('img/artist-thumb.jpg', 'artist', [ 'class' => 'span1']) }}
					</div>
				</div>
				<a href="" class="more">View more</a>
			</div>
		</div>	
	</div>

	<div class="span5 offset1">
		<div class="row sec">
			<div class="span5 pull-right">
				<div class="buy-ticket">
				</div>
			</div>
		</div>

		<div class="row sec event-detail">
			<div class="span5">
				<div class="date">26th Aug, Sun</div>
				<div class="time">5:00pm - 10:00pm</div>
				<div class="place">Mauriya</div>
				<div class="city">New Delhi</div>
				<div class="contact">+91 999999 999999</div>
				<div class="contact">+91 999999 999999</div>
			</div>
		</div>

		<div class="row social-connect sec">
			<div class="span5">
				<p class="sec-heading">Social Connect</p>
				<div class="span1 social-item facebook"></div>
				<div class="span1 social-item twitter"></div>
				<div class="span1 social-item youtube"></div>
			</div>	
		</div>
	</div>
</div>

<div class="row videos-list">
	<div class="span12">
		
		@foreach(range(1, 10) as $r)
			{{ render('partials.videos') }}
		@endforeach
		
	</div>
</div>