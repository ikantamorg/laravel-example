define(
	[],
	function () {

		var currentMedia = null;
		var sound = null;

		return {
			setCurrentMedia: function (item) {
				currentMedia = item;
			},
			getCurrentMedia: function () {
				return currentMedia;
			},
			play: function () {
				var model = currentMedia.get('model');
				console.log(model);
				if(sound) {
					sound.stop();
					sound.unload();
				}
				sound = soundManager.createSound({
					id: model.slug,
					url: model.stream_url,
					autoload: true,
					onload: function () {

					},
					volume: 50
				});

				sound.play();
			},
			pause: function () {

			},
			isPlaying: function () {
				
			}
		};
	}
);