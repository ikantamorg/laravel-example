define(
	[
		'./driver/audio',
		'./driver/video'
	],
	function (audioDriver, videoDriver) {

		var driver = null;

		return {
			play: function (item) {
				if(item.type === 'song')
					driver = audioDriver;
				else if(item.type === 'video')
					driver = videoDriver;
				else
					return;

				driver.setCurrentMedia(item);
				driver.play();
			},

			togglePlayPause: function () {
				if(! driver ) return;
				
				if(driver.isPlaying())
					return true;
				else if(driver.isPaused())
					return false;
			},

			getCurrentMedia: function () {
				if(! driver ) return;
				return driver.currentMedia;
			},

			isPlaying: function () {
				return driver && driver.isPlaying();
			}
		};
	}
);