define(
	[
		'dash/modules/player/dom'
	],
	function (dom) {
		var videoObj = dom.videoObj().get(0);
		var currentMedia = null;

		return {
			setCurrentMedia: function (item) {
				currentMedia = item;
			},
			getCurrentMedia: function () {
				return currentMedia;
			},
			play: function () {
				var videoId = currentMedia.get('model').youtube_id;
				videoObj.loadVideoById(videoId, 0, 'default');
				videoObj.setVolume(100);
			},
			pause: function () {

			},
			isPlaying: function () {
				return false;
			}
		};
	}
);