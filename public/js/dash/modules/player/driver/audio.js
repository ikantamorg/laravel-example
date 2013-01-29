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
				
				if(sound && sound.id !== item.get('model').slug) {
					sound.stop();
					sound.unload();
				}
				
				sound = createSoundFromItem(item);
				sound.play();
			},

			resume: function () {
				sound.paused && sound.resume();
			},

			pause: function () {
				sound.paused || sound.pause();
			},

			isPlaying: function () {
				return false;
			}
		};
	}
);