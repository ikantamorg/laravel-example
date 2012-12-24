define(function () {

	var errorHandler = {};

	errorHandler.interface = {
		playerSetupFailed: { id: 'playerSetupFailed' }
	};

	errorHandler.handleError = function (id, errorData) {
		console.log(id, errorData);
	};

	return errorHandler;
});