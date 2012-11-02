define(function () {

	var makeRequest = function (method, target) {
		if(method === 'GET') {
			window.location.href = target;
			return;
		}

		var html = '<form action="'+target+'" method="POST">';

		if(method === 'PUT' || method === 'DELETE')
			html += '<input type="hidden" name="_method" value="'+method+'">';

		html += '</form>';

		$(html).submit();
	};

	return {
		makeRequest: makeRequest
	};

});