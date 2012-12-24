define(
	[
		'./driver/audio',
		'./driver/video'
	],
	function (audioDriver, videoDriver) {

		var driver = null;

		return {
			play: function (item) {
				if(item.getType() === 'song')
					driver = audioDriver;
				else if(item.getType() === 'video')
					driver = videoDriver;
				else
					return;

				driver.setCurrentMedia(item);
				driver.play();
			},

			togglePlayPause: function () {
				if(! driver ) return;
				
				if(driver.isPlaying())
					driver.pause();
				else
					driver.play();
			},

			getCurrentMedia: function () {
				if(! driver ) return;
				return driver.getCurrentMedia();
			},

			isPlaying: function () {
				return driver && driver.isPlaying();
			}
		};
	}
);