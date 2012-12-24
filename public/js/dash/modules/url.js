define(function () {
	return function (uri) {
		var baseUrl = location.protocol + '//' + location.host;
		return uri ? baseUrl + '/' + uri : baseUrl;
	};
});