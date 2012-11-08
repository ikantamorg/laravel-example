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

			dom.playlistToggleBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.playlistToggled.id);
			});

			dom.playlistCollapseBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.playlistToggled.id);
			});

			dom.videoScreenToggleBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.videoScreenToggled.id);
			});

			dom.videoScreenCollapseBtn().on('click', function () {
				vent.reactor.trigger(vent.interface.videoScreenToggled.id);
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