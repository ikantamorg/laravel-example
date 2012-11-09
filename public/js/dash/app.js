define(
	[
		'./vent',
		'./modules/linkHandler',
		'./modules/player',
		'./modules/triggers',
	],
	function (vent, linkHandler, player, triggers) {

		return {
			start: function () {
				linkHandler.init();
				player.init();
				triggers.init();
			}
		};
	}
);