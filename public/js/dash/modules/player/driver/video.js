define(
	[
		'dash/modules/player/dom'
	],
	function (dom) {
    var videoScreen = dom.videoScreen();
		var videoObj = dom.videoObj().get(0);
		var currentMedia = null;

    var YTPlayer = new YT.Player(videoObj, {
      height: 320,
      width: 570,
      playerVars: { autoplay: 0, controls: 0 }
    });

		return {
			setCurrentMedia: function (item) {
				currentMedia = item;
			},
			getCurrentMedia: function () {
				return currentMedia;
			},
			play: function () {
				var videoId = currentMedia.get('model').youtube_id;
        YTPlayer.loadVideoById(videoId, 0, 'default');
				YTPlayer.setVolume(100);
        videoScreen.show();
			},
			pause: function () {
        YTPlayer.getPlayerState() === 2 || YTPlayer.pauseVideo();
			},

      resume: function () {
        YTPlayer.getPlayerState() === 2 && YTPlayer.playVideo();
      },

      stop: function () {
        YTPlayer.stopVideo();
        videoScreen.hide();        
      },
			isPlaying: function () {
				return YTPlayer.getPlayerState() === 1;
			},

      duration: function () {
        if(! currentMedia) return 0;
        return currentMedia.getDuration();
      },

      streamed: function () {
        return YTPlayer.getVideoLoadedFraction();
      },

      played: function () {
        if(! currentMedia ) return 0;
        return YTPlayer.getCurrentTime()/currentMedia.getDuration();
      }
		};

	}
);