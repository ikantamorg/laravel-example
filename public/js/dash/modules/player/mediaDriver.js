define(
	[
		'./driver/audio',
		'./driver/video'
	],
	function (audioDriver, videoDriver) {

		var driver = null;

		return {
			load: function (item) {
        driver && driver.stop();
				if(item.getType() === 'song')
					driver = audioDriver;
				else if(item.getType() === 'video')
					driver = videoDriver;
				else
					return;

				driver.setCurrentMedia(item);
			},

			play: function () {
				if(! driver ) return;
				driver.play();
			},

			togglePlayPause: function () {
				if(this.isPlaying())
					this.pause();
				else
					this.play();
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