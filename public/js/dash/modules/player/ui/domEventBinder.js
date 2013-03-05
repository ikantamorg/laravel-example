define(
	[
		'dash/modules/player/vent',
		'dash/modules/player/dom',
	],
	function (vent, dom) {
		var bindEventsToDom	= function () {
			dom.prevBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.prevBtnPressed.id);
			});

			dom.nextBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.nextBtnPressed.id);
			});

			dom.playToggleBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.playBtnToggled.id);
			});

			dom.playlistWindowToggleBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.playlistWindowToggled.id);
			});

			dom.playlistWindowCollapseBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.playlistWindowToggled.id);
			});

			dom.videoWindowToggleBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.videoWindowToggled.id);
			});

			dom.videoWindowCollapseBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.videoWindowToggled.id);
			});

			dom.playlistClearBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.playlistCleared.id);
			});

			dom.videoFullScreenBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.videoFullScreenToggled.id);
			});

		};

		return {
			run: function () {
				bindEventsToDom();
			}
		};
	}
);