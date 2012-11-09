define(
	[],
	function () {

		var currentMedia = null;

		return {
			setCurrentMedia: function (item) {
				currentMedia = item;
			},
			getCurrentMedia: function () {
				return currentMedia;
			},
			play: function () {

			},
			pause: function () {

			},
			isPlaying: function () {
				
			}
		};
	}
);