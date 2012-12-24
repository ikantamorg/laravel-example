<div class="row title"></div>

<div class="row right-pane">
	<div class="span4">

		<div class="row featured right-item">
			<div class="span4">
				<p class="heading">FEATURED</p>

				<div class="featured-item">
					<div id="carousel" class="carousel slide">
			            <div class="carousel-inner">
			            	@foreach($featured as $i => $item)
			            		<div class="item<?=$i===0 ? ' active' : ''?>">
			            			@if($resource_type === 'events' || $resource_type === 'artists')
			            				<img src="{{ $item->get_profile_photo_url('thumb') }}" alt="{{ $item->name }}">
			            			@elseif($resource_type === 'songs')
			            				<img src="{{ ($a = head($item->artists)) ? $a->get_profile_photo_url('thumb') : '' }}">
			            			@elseif($resource_type === 'videos')
			            				<img src="{{ $item->thumb }}" alt="{{ $item->name }}">
			            			@endif			            			
			            		</div>
			            	@endforeach
			            <?php /*
			              <div class="item active">
			                {{ HTML::image('img/feat1.jpg', 'feat1') }}

			                <div class="carousel-caption">
			                  <a href="{{ URL::to('event-profile/info') }}">Rock Around the Globe</a>
			                  <p>26th Aug, Sat</p>
			                  <p>5:00pm - 10:30pm</p>
			                  <p>Mauriya</p>
			                </div>
			              </div>
			              <div class="item">
			                {{ HTML::image('img/feat2.jpg', 'feat2') }}
			                <div class="carousel-caption">
			                  <a href="{{ URL::to('artist-profile/info') }}">Blue Over Red</a>
			                  <p>Jalebi Cartel</p>
			                  <p>(03:40)</p>
			                  <p>21 Events</p>
			                </div>
			              </div>
			              <div class="item">
			                {{ HTML::image('img/feat3.jpg', 'feat3') }}
			                <div class="carousel-caption">
			                  <a href="#">Jalebee Cartel</a>
			                  <p>House/ Techno/ Electronica</p>
			                  <p>35 Songs</p>
			                  <p>21 Events</p>
			                </div>
			              </div>
			            </div>
			        	*/ ?>
			            <a class="left carousel-control" href="#carousel" data-slide="prev">&lsaquo;</a>
			            <a class="right carousel-control" href="#carousel" data-slide="next">&rsaquo;</a>
			        </div>
					
				</div>
			</div>	
		</div>


		<div class="row social-connect right-item ">
			<div class="span4">
				<p class="heading">SOCIAL CONNECT</p>

				<div class="row">
					<div class="span1 social-item facebook"></div>
					<div class="span1 social-item twitter"></div>
					<div class="span1 social-item youtube"></div>
					<div class="span1 social-item googleplus"></div>
				</div>

			</div>	
		</div>
		
	</div>
	
</div>


