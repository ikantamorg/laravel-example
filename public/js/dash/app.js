define(
	[
		'./vent',
		'./modules/linkHandler',
		'./modules/player'
	],
	function (vent, linkHandler, player) {

		return {
			start: function () {
				linkHandler.init();
				player.init();
			}
		};
	}
);