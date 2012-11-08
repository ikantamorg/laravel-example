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
				'itemUnFavoritedSuccess',
			];

			_.each(dashToPlayerEvents, function (event) {
				dashVent.reactor.on(dashVent.interface[event].id, function (itemType, itemId) {
					playerVent.reactor.trigger(playerVent.interface[event].id, itemType, itemId);
				});
			});

			var playerToDashEvents = [
				'itemFavorited',
				'itemUnFavorited'
			];

			_.each(playerToDashEvents, function (event) {
				playerVent.reactor.on(playerVent.interface[event].id, function (itemType, itemId) {
					dashVent.reactor.trigger(dashVent.interface[event].id, itemType, itemId);
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