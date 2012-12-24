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
				console.log('here');
				var videoId = currentMedia.get('model').youtube_id;
				videoObj.loadVideoById(videoId, 0, 'default');
			},
			pause: function () {

			},
			isPlaying: function () {
				
			}
		};
	}
);