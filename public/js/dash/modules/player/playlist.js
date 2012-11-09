define(
	[
		'dash/modules/ajax',
		'./dom',
		'./vent',
		'./mediaDriver',
		'./playlist/Item',
		'./playlist/List',
		'./playlist/ListView'
	],
	function (ajax, dom, playerVent, mediaDriver, Item, List, ListView) {

		var list = new List;
		var listView = new ListView({
			$el: dom.playlistHolder(),
			list: list
		});
		
		var playlist = {
			instantiate: function () {
				ajax.getPlaylistItems(function (items) {
					list.add(items, {silent: true});
					listView.render();
				}, this);
			},

			findItem: function (type, id) {
				return list.find(function (item) {
					return item.get('type') === type && item.get('model').id == id
				});
			},

			addNewItem: function (type, id, callback, ctx) {
				ajax.addItemToPlaylist(type, id, function (data) {
					var item = new Item(data);
					list.add(item);
					ctx ? callback.call(ctx, {item: item}) : callback;
				}, this);
			},

			currentItem: function () {
				return mediaDriver.getCurrentMedia();
			},

			removeItem: function (item) {
				ajax.removeItemFromPlaylist(list.indexOf(item), function (data) {
					if(this.currentItem() === item)
						playerVent.reactor.trigger(playerVent.interface.itemFinished.id, item);
					list.remove(item);
				}, this);
			},

			nextItem: function () {
				var currentItemIndex = list.indexOf(this.currentItem()),
					nextItemIndex = (currentItemIndex === (list.length-1)) ? 0 : currentItemIndex + 1
				;

				return list.at(nextItemIndex);
			},

			prevItem: function () {
				var currentItemIndex = list.indexOf(this.currentItem()),
					prevItemIndex = (currentItemIndex === 0) ? (list.length - 1) : currentItemIndex - 1
				;

				return list.at(prevItemIndex);
			},

			firstItem: function () {

			},

			lastItem: function () {

			},
		};

		playlist.instantiate();

		return playlist;
	}
);