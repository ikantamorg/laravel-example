

	<div class="row tabs">
		<div class="span12">
			<ul class="unstyled">
				<li class="span2 {{ $partial === 'info' ? 'active' : '' }}"><a href="{{ URL::to('artist-profile/info') }}">INFO</a></li>
				<li class="span2 {{ $partial === 'songs' ? 'active' : '' }}"><a href="{{ URL::to('artist-profile/songs') }}">SONGS</a></li>
				<li class="span2 {{ $partial === 'events' ? 'active' : '' }}"><a href="{{ URL::to('artist-profile/events') }}">EVENTS</a></li>
				<li class="span2 {{ $partial === 'videos' ? 'active' : '' }}"><a href="{{ URL::to('artist-profile/videos') }}">VIDEOS</a></li>
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
					<div class="demand">
					</div>
				</div>
			</div>

			<div class="row booking sec">
				<div class="span5">
					<p class="sec-heading">Management/ Booking</p>
					<div class="agent">
						<div class="agent-name">	
							<a class="name" href="#">Dev Bhatia,</a>

							<div class="popup">
								{{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow']) }}
								{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
								<div class="popup-detail">
									<div class="popup-name"><a href="{{ URL::to('artist-profile/info') }}">Indian OceanIndian OceanIndian 		OceanIndian OceanIndian Ocean</a>
									</div>

									<div class="popup-facts">
										<a class="pull-left" href="{{ URL::to('artist-profile/events') }}">22 Events</a>
									</div>

									<div class="socials">
										<div class="icon pull-left fav"><a href="#" rel="tooltip" title="Add to favorites"></a></div>
										<div class="icon facebook"><a href="#" rel="tooltip" title="Share on Facebook"></a></div>
										<div class="icon twitter"><a href="#" rel="tooltip" title="Share on Twitter"></a></div>
									</div>
								</div>	

							</div>

							<a class="agency" href="#">UnMute Agency</a>
							
						</div>
						<div class="p contact"><span>T : </span>+91 99999 99999</div>
						<div class="p email"><span>E : </span>agent at the rate agency.com</div>
					</div>
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

	<div class="row">
		<div class="span6">

			<div class="row members sec">
				<div class="span6">
					<p class="sec-heading">Members</p>
					<div class="artist-name">	
						<a href="#">Ash Roy</a>
						<div class="popup">
							{{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow']) }}
							{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
							<div class="popup-detail">
								<div class="popup-name"><a href="{{ URL::to('artist-profile/info') }}">Indian OceanIndian OceanIndian 		OceanIndian OceanIndian Ocean</a>
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
						
						<p class="roles">(Vocalist and Percussion)</p>
					</div>

					<div class="artist-name">	
						<a href="#">Arjun Vagale</a>
						<div class="popup">
							{{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow']) }}
							{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
							<div class="popup-detail">
								<div class="popup-name"><a href="{{ URL::to('artist-profile/info') }}">Indian OceanIndian OceanIndian 		OceanIndian OceanIndian Ocean</a>
								</div>

								<div class="popup-facts">
									<a class="pull-left" href="{{ URL::to('artist-profile/songs') }}">22 Songs</a>
									<a class="pull-left" href="{{ URL::to('artist-profile/events') }}">22 Events</a>
								</div>

								<div class="socials">
									<div class="icon pull-left fav"><a href="#" rel="tooltip" title="Add to favorites"></a></div>
									<div class="icon facebook"><a href="#" rel="tooltip" title="Share on Facebook"></a></div>
									<div class="icon twitter"><a href="#" rel="tooltip" title="Share on Twitter"></a></div>
								</div>
							</div>	

						</div>
						
						<p class="roles">(Groove and Mixing)</p>
					</div>

					<div class="artist-name">	
						<a href="#">Ashwin Mani Sharma</a>
						<div class="popup">
							{{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow']) }}
							{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
							<div class="popup-detail">
								<div class="popup-name"><a href="{{ URL::to('artist-profile/info') }}">Indian OceanIndian OceanIndian 		OceanIndian OceanIndian Ocean</a>
								</div>

								<div class="popup-facts">
									<a class="pull-left" href="{{ URL::to('artist-profile/songs') }}">22 Songs</a>
									<a class="pull-left" href="{{ URL::to('artist-profile/events') }}">22 Events</a>
								</div>

								<div class="socials">
									<div class="icon pull-left fav"><a href="#" rel="tooltip" title="Add to favorites"></a></div>
									<div class="icon facebook"><a href="#" rel="tooltip" title="Share on Facebook"></a></div>
									<div class="icon twitter"><a href="#" rel="tooltip" title="Share on Twitter"></a></div>
								</div>
							</div>	

						</div>

						<p class="roles">(Synths and SX)</p>
					</div>

					<div class="artist-name">	
						<a href="#">G "Force" Arjun</a>
						<div class="popup">
							{{ HTML::image('img/arrow.png', 'arrow', [ 'class' => 'arrow']) }}
							{{ HTML::image('img/artist-thumb.jpg', 'artist') }}
							<div class="popup-detail">
								<div class="popup-name"><a href="{{ URL::to('artist-profile/info') }}">Indian OceanIndian OceanIndian 		OceanIndian OceanIndian Ocean</a>
								</div>

								<div class="popup-facts">
									<a class="pull-left" href="{{ URL::to('artist-profile/songs') }}">22 Songs</a>
									<a class="pull-left" href="{{ URL::to('artist-profile/events') }}">22 Events</a>
								</div>

								<div class="socials">
									<div class="icon pull-left fav"><a href="#" rel="tooltip" title="Add to favorites"></a></div>
									<div class="icon facebook"><a href="#" rel="tooltip" title="Share on Facebook"></a></div>
									<div class="icon twitter"><a href="#" rel="tooltip" title="Share on Twitter"></a></div>
								</div>
							</div>	

						</div>

						<p class="roles">(Bass Guitar)</p>
					</div>
				</div>	
			</div>

			<div class="row about sec">
				<div class="span6">
					<p class="sec-heading">About</p>
					<p class="sec-matter">
						Jalebee Cartel has challenged the notion that 
						dance music is a Western domain by single-hande
						-dly putting India on the international EDM map.
					</p> 

					<p class="sec-matter">
						Composed of four members, Arjun Vagale ,
						Ash Roy , Ashvin Mani Sharma  and G-force Arjun, 
						Jalebee has been taking India by storm for over 
						five years. From individual DJ sets to live gigs, 
						producing to composing, the multi-talented group
						does it all. 
					</p>
					<a href="" class="more">Read More</a>
				</div>
			</div>



		</div>

		<div class="span5 offset1 right">

			<div class="row labels sec">
				<div class="span5">
					<p class="sec-heading">Labels</p>
					<p class="labeling">DMakTub </p> 
					<p class="labeling">Ostwind</p>
					<p class="labeling">Frequenza</p>
					<p class="labeling">Vapour</p>
					<p class="labeling">eVapour8</p>
					<p class="labeling">Neurotraxx Deluxe</p>
					<p class="labeling">Elektrotribe</p>
					
				</div>
			</div>

		</div>
	</div>	





	
