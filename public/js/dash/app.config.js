requirejs.config({
	baseUrl: location.protocol + '//' + location.host + '/js',
});

function onYouTubeIframeAPIReady() {
  console.log('here');
}

$(document).on('soundManager:loaded', function () {
	
	requirejs(['dash/app'], function (dash) {
		
		dash.start();

	});
});

