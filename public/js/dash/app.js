define(
	['./vent', './modules/linkHandler'],
	function (vent, linkHandler) {

		return {
			start: function () {
				linkHandler.init();
			}
		};
	}
);