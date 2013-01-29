<div class="span22 offset1">
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
							<p class="song-name"></p>
							<a class="artist-name pull-right"></a>
						</div>
					</div>
					
					<div class="row">
						<div class="span7">
							<p class="time-done">
								
							</p>
							
							<div class="stream">
								<div class="stream-1" style="width: 0%;"></div>
								<div class="stream-2" style="width: 0%;"></div>
								<div class="handle" style="left: 0%;"></div>
							</div>

							<p class="time-left">
								
							</p>	
						</div>

						<div class="span2">
							<div class="sound"></div>

							<div class="volume">
								<div class="stream-1" style="width: 100%"></div>
								<div class="handle" style="left: 100%"></div>
							</div>
						</div>

						<div class="span3 socials ">
							<div class="icon fav" style="display:none">
								<a rel="tooltip" title="Add to Favorites"></a>
							</div>
							<div class="icon share" style="display:none">
								<a></a>
								<div class="popup2">
									<p>Share:</p>
									<img src="{{ URL::to_asset('img/arrow-mirror.png') }}" class="arrow">
									<div class="icon facebook"><a></a></div>
									<div class="icon twitter"><a></a></div>
								</div>
							</div>
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
					<object
						type="application/x-shockwave-flash"
						class="video-box"
						width="570" height="320"
						data="http://www.youtube.com/apiplayer?enablejsapi=1&version=3"
					>
						<param name="allowScriptAccess" value="always">
						<param name="allowFullScreen" value="true">
					</object>
				</div>
			</div>

			<div class="row frame playlist">
				<div class="head">
					<div class="collapse pull-right"></div>
					<div class="clear pull-right">Clear all</div>
				</div>
				<div class="screen">
					<div class="playlist">
						
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
			<div class="source" style="display: none">
				<p>source:</p>
				<div class="logo youtube"></div>
			</div>
		</div>
	</div>
</div>