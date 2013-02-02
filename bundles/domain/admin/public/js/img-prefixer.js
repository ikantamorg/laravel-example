$(function () {
	var $radioInputs = $('input[type=radio]');

	

	var shouldDisable = function () {
		var urlSegments = window.location.href.split('/').slice(2),
			allowedSegments = ['edit'],
			length = allowedSegments.length
		;

		for(var i=0; i < length; i++)
			if(urlSegments.indexOf(allowedSegments[i]) > -1)
				return false;

		return true;
	};

	if(shouldDisable())
		return;
	
	_.chain($radioInputs).each(function (el, i) {
		var $radio = $(el);

		if(! $radio.data('url') )
			return;

		$radio.before($('<img>', { src: $radio.data('url') }));
	});
});