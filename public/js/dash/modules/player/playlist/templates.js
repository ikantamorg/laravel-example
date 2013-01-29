define(
	[],
	function () {
		return {
			songItemTmpl: _.template($('#player-playlist-song-tmpl').html()),
			videoItemTmpl: _.template($('#player-playlist-video-tmpl').html())
		}
	}
);