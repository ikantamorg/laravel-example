<script type="text/html" id="player-playlist-song-tmpl">
	<?php /*<div class="row list-item"> */?>
		<div class="span1 play-song playBtn"></div>
		<div class="span8">
			<div class="row song-name">
				<div class="span8">
					<%-model.name%>
				</div>
			</div>
			<div class="row artist-name">
				<div class="span8">
					<%-_.map(model.artists, function (a) { return a.name; }).join(', ')%>
				</div>
			</div>
		</div>
		<div class="span2 song socials">
			<div class="icon fav"><a rel="tooltip" title="Add to Favorites"></a></div>
			<div class="icon share">
				<a></a>
				<div class="popup">
					<p>Share:</p>
					<img src="<?=URL::to_asset('img/arrow.png')?>" class="arrow">
					<div class="icon facebook"><a></a></div>
					<div class="icon twitter"><a></a></div>
				</div>
			</div>
		</div>
		<div class="span1 close"></div>
	<?php /*</div>*/ ?>
</script>