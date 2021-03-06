define(
	[	
		'dash/vent',
		'./player/vent',
		'./player/controller',
	],
	function (dashVent, playerVent, playerController) {

		var player = {};

		player.setupInteractionWithDashboard = function () {
			var dashToPlayerEvents = [
				'itemPlayed',
				'itemQueued',
				'itemFavoritedSuccess',
				'itemUnfavoritedSuccess',
			];

			_.each(dashToPlayerEvents, function (event) {
				dashVent.reactor.on(dashVent.interface[event].id, function (options) {
					playerVent.reactor.trigger(playerVent.interface[event].id, options);
				});
			});

			var playerToDashEvents = [
				'itemFavorited',
				'itemUnfavorited'
			];

			_.each(playerToDashEvents, function (event) {
				playerVent.reactor.on(playerVent.interface[event].id, function (options) {
					dashVent.reactor.trigger(dashVent.interface[event].id, options);
				});
			});

			dashToPlayerEvents = null;
			playerToDashEvents = null;
		};

		player.init = function () {
			this.setupInteractionWithDashboard();
			playerController.start();
		};

		player.off = function () {
			playerController.stop();
		}

		return player;
	}
);