requirejs.config({
	baseUrl: location.protocol + '//' + location.host + '/js',
});

$(document).on('soundManager:loaded', function () {
	
	requirejs(['dash/app'], function (dash) {
		
		dash.start();

	});
});
