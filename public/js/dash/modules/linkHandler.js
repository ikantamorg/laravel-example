define(
	[
		'dash/vent',
		'./linkHandler/processor'
	],

	function (dashVent, linkProcessor) {

		var linkHandler = {
			extractOptions: function ($anchor) {
				if($anchor.options)
					return $anchor.options;

				var $a = $anchor

				var options = {
					target: $a.attr('href'),
					stopDefault: ($a.data('stop-default') === "yes"),
					usesAjax: ($a.data('use-ajax') === "yes"),
					method: ($a.data('method') ? $a.data('method') : 'GET'),
					openPopup: ($a.data('open-popup') === "yes"),
					driver: $a.data('driver')
				};

				$anchor.options = options;
				
				return $anchor.options;
			},

			process: function ($anchor) {
				linkProcessor.run($anchor, this.extractOptions($anchor));
			}
		};

		linkHandler.init = function () {
			$('a').on('click', function (ev) {
				var $anchor = $(this),
					options = linkHandler.extractOptions($anchor)
				;

				if(options.stopDefault) {
					ev.preventDefault();
				}

				linkHandler.process($anchor);
			});
		};

		return linkHandler;
	}
);