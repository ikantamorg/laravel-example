define(
	[
		'dash/vent',
		'./drivers/httpVerbRequest'
	],
	function (dashVent,httpVerbRequestDriver) {
		var linkProcessor = {
			run: function ($anchor, options) {
				if(! options.usesAjax && options.stopDefault && ! options.openPopup && options.driver === 'httpVerbRequest')
					httpVerbRequestDriver.makeRequest(options.method, options.target)
				
			}
		};

		return linkProcessor;
	}
);