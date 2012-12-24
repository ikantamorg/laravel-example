define(function () {
	return {
		interface: {
			itemPlayed: {id: 'itemPlayed'},
			itemQueued: {id: 'itemQueued'},

			itemFavoritedSuccess: {id: 'itemFavoritedSuccess'},
			itemUnfavoritedSuccess: {id: 'itemUnfavoritedSuccess'},
		},

		reactor: _.extend({}, Backbone.Events)
	}
});