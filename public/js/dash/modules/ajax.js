define(
	[
		'dash/vent',
		'./errorHandler',
		'./url',
	],
	function (dashVent, errorHandler, url) {

		return {
			getPlaylistItems: function (callback, ctx) {
				$.ajax({
					url: url('player/playlist'),
					dataType: 'json',
					success: function (data) {
						ctx ? callback.call(ctx, data) : callback(data);
					},
					error: function (data) {
						console.log(data);
					}
				});
			},

			addItemToPlaylist: function (type, id, callback, ctx) {
				$.ajax({
					url: url('player/playlist/item/' + type + '/' + id),
					dataType: 'json',
					type: 'POST',
					success: function (data) {
						ctx ? callback.call(ctx, data) : callback(data);
					},
					error: function (data) {
						console.log(data);
					}
				});
			},

			removeItemFromPlaylist: function (index, callback, ctx) {
				$.ajax({
					url: url('player/playlist/item/' + index),
					dataType: 'json',
					type: 'DELETE',
					success: function (data) {
						ctx ? callback.call(ctx, data) : callback(data);
					},
					error: function (data) {
						console.log(data);
					}
				})
			}
		};

	}
);