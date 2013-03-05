define(
	[],
	function () {

		var currentMedia = null;
		var sound = null;

		var createSoundFromItem = function (item) {
			var model = item.get('model');
			return soundManager.createSound({
				id: model.slug,
				url: model.stream_url,
				autoload: true,
				volume: 100
			});
		};

		return {
			setCurrentMedia: function (item) {
				currentMedia = item;
			},
			getCurrentMedia: function () {
				return currentMedia;
			},
			play: function () {
				item = this.getCurrentMedia();
				sound = createSoundFromItem(item);
				sound.play();
			},

      stop: function () {
        if(! sound ) return;
        sound.stop();
        sound.unload();
      },

			resume: function () {
				sound && sound.paused && sound.resume();
			},

			pause: function () {
				sound && sound.paused || sound.pause();
			},

			isPlaying: function () {
				return sound && ! sound.paused;
			},

      duration: function () {
        if(! currentMedia || ! sound) return 0;
        return currentMedia.getDuration() || (sound.durationEstimate/1000);
      },

      streamed: function () {
        if(! currentMedia || ! sound) return 0;
        var duration = this.duration();
        var r = sound.duration/(1000 * duration);

        if(r === NaN || r === Infinity) return 0;

        return r;
      },

      played: function () {
        if(! currentMedia || ! sound) return 0;
        var duration = this.duration();
        var r = sound.position/(1000 * duration);
        
        if(r === NaN || r === Infinity) return 0;

        return r
      }
		};
	}
);