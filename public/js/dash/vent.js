define(function () {
	return {
		interface: {
			itemPlayed: {id: 'itemPlayedSuccess'},
			itemQueued: {id: 'itemQueuedSuccess'},

			itemFavoritedSuccess: {id: 'itemFavoritedSuccess'},
			itemUnFavoritedSuccess: {id: 'itemUnFavoritedSuccess'},
		},

		reactor: _.extend({}, Backbone.Events)
	}
});