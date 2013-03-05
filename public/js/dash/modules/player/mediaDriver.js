define(
	[
		'./driver/audio',
		'./driver/video'
	],
	function (audioDriver, videoDriver) {

		var driver = null;
    
    var provideProgressInfo = function () {
      if(! driver || ! driver.getCurrentMedia()) return;
      driver.getCurrentMedia().trigger('progress', {
        streamed: driver.streamed(),
        played: driver.played(),
        duration: driver.duration()
      });
    };

    var timer = setInterval(provideProgressInfo, 1000);

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
        this.getCurrentMedia().trigger('played');
			},

      togglePlayPause: function () {
        if(! driver ) return;

				if(this.isPlaying()) {
					driver.pause();
          this.getCurrentMedia().trigger('paused');
        } else {
          driver.resume();
          this.getCurrentMedia().trigger('resumed');
        }
			},

			getCurrentMedia: function () {
				if(! driver ) return;
				return driver.getCurrentMedia();
			},

			isPlaying: function () {
				return driver && driver.isPlaying();
			},

      getPlayed: function () {
        return driver.played();
      },

      getStreamed: function () {
        return driver.streamed();
      }
		};
	}
);