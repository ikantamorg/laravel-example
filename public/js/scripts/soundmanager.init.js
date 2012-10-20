soundManager.setup({
	url: location.protocol + '//' + location.host + '/swf/',

	onready: function () {
		$(document).trigger('soundManager:loaded');
	}
});