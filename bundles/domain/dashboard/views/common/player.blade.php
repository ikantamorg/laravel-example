<div class="row">
	<div class="span4">
		<div class="control pull-right">
			<div class="previous"></div>
			<div class="play"></div>
			<div class="forward"></div>
		</div>
	</div>

	<div class="span12 offset1">
		<div class="row display">
			<div class="span12">
				<div class="row">
					<div class="span12">
						<p class="song-name">Bharam Paap ke</p>
						<a class="artist-name pull-right" href="{{ URL::to('artist-profile/info') }}">Jalebi Cartel</a>
					</div>
				</div>
				
				<div class="row">
					<div class="span7">
						<p class="time-done">
							03:02
						</p>
						
						<div class="stream">
							<div class="stream-1" style="width: 70%;"></div>
							<div class="stream-2" style="width: 20%;"></div>
							<div class="handle" style="left:20%;"></div>
						</div>

						<p class="time-left">
							03:55
						</p>	
					</div>

					<div class="span2">
						<div class="sound"></div>

						<div class="volume">
							<div class="stream-1" style="width: 70%;"></div>
							<div class="handle" style="left:70%;"></div>
						</div>
					</div>

					<div class="span3 socials ">
						<div class="icon fav"><a rel="tooltip" title="Add to Favorites"></a></div>
						<div class="icon share">
							<a></a>
							<div class="popup2">
								<p>Share:</p>
								{{ HTML::image('img/arrow-mirror.png', 'arrow', [ 'class' => 'arrow']) }}
								<div class="icon facebook"><a></a></div>
								<div class="icon twitter"><a></a></div>
							</div>
						</div>
						<div class="icon buy"><a  rel="tooltip" title="Buy this Song"></a></div>
					</div>
					

				</div>
			</div>	
		</div>	

		<div class="row frame video">
			<div class="head">
				<div class="collapse pull-right"></div>
				<div class="full-screen pull-right"><a rel="tooltip" title="View Full-screen"></a></div>
			</div>
			<div class="screen">
				<h1>VIDEO</h1>
			</div>
		</div>

		<div class="row frame playlist">
			<div class="head">
				<div class="collapse pull-right"></div>
				<div class="clear pull-right">Clear all</div>
			</div>
			<div class="screen">
				<div class="playlist">
					@foreach(range(1, 3) as $r)
						{{ render('dashboard::common.player.playlist-item') }}
					@endforeach
				</div>
			</div>
		</div>

	</div>

	<div class="span2">
		<div class="control pull-right">
			<div class="playlist">
			</div>
			<div class="video">
				
			</div>
		</div>
	</div>

	<div class="span2 offset1">
		<div class="source">
			<p>source:</p>
			<div class="logo youtube"></div>
		</div>
	</div>
</div>