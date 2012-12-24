define(
	[
		'./vent',
		'./ui',
		'./playlist',
		'./mediaDriver',
	],
	function (vent, ui, playlist, mediaDriver) {

		var controller = {

			playItem: function (options) {
				if(! options) return;

				var item = null;

				if(options.item)
					item = options.item;
				else if(options.type && options.id)
					item = playlist.findItem(options.type, options.id);

				if( item ) {
					mediaDriver.play(item); // plays the item

					ui.loadItemToDisplay(item); //display the item in HUD
					ui.trackProgressOfMedia(mediaDriver); //tracks the progress and shit of a media

					vent.reactor.trigger(vent.interface.itemPlayedSuccess.id, item);
				} else {
					// attaches the item to playlist, should also update the view of the playlist
					playlist.addNewItem(options.type, options.id, this.playItem, this);
				}
			},

			queueItem: function (options) {
				if(! options) return;

				var item = null;

				if(options.item)
					item = options.item;
				else if(options.type && options.id)
					item = playlist.findItem(options.type, options.id);

				if( ! item ) {
					// attaches the item to playlist, should also update the view of the playlist
					playlist.addNewItem(options.type, options.id, this.queueItem, this);
				}
			},

			cleanUpDisplay: function (lastPlayedItem) {
				ui.cleanUpDisplay();
				if(playlist.nextItem() && playlist.nextItem() !== lastPlayedItem)
					this.playNextItem();

			},

			playNextItem: function () {
				var nextItem = playlist.nextItem();
				
				if(! nextItem ) return;
				
				this.playItem({item: nextItem});
			},

			playPrevItem: function () {
				var prevItem = playlist.prevItem();

				if(! prevItem) return;

				this.playItem({item: prevItem});
			},

			togglePlayPause: function () {
				if(mediaDriver.isPlaying()) {
					mediaDriver.togglePlayPause();
					ui.togglePlayPauseBtn();
					vent.reactor.trigger(vent.interface.itemPausedSuccess.id, mediaDriver.getCurrentMedia());
				} else {
					mediaDriver.togglePlayPause();
					ui.togglePlayPauseBtn();
					vent.reactor.trigger(vent.interface.itemPlayedSuccess.id, mediaDriver.getCurrentMedia());
				}
			},

			togglePlaylistWindow: function () {
				ui.togglePlaylistWindow();
			},

			toggleVideoWindow: function () {
				ui.toggleVideoWindow();
			},

			clearPlaylist: function () {
				playlist.clear();
			},

			toggleVideoFullScreen: function () {
				ui.toggleVideoFullScreen();
			},

			removeItemFromQueue: function (item) {
				playlist.removeItem(item);
			},

			start: function () {
				vent.reactor.on(vent.interface.itemPlayed.id, this.playItem, this);
				vent.reactor.on(vent.interface.itemFinished.id, this.cleanUpDisplay, this);
				vent.reactor.on(vent.interface.nextBtnPressed.id, this.playNextItem, this);
				vent.reactor.on(vent.interface.prevBtnPressed.id, this.playPrevItem, this);
				vent.reactor.on(vent.interface.playBtnToggled.id, this.togglePlayPause, this);
				vent.reactor.on(vent.interface.playlistWindowToggled.id, this.togglePlaylistWindow, this);
				vent.reactor.on(vent.interface.videoWindowToggled.id, this.toggleVideoWindow, this);
				vent.reactor.on(vent.interface.playlistCleared.id, this.clearPlaylist, this);
				vent.reactor.on(vent.interface.videoFullScreenToggled.id, this.toggleVideoFullScreen, this);
				vent.reactor.on(vent.interface.itemRemovedFromQueue.id, this.removeItemFromQueue, this);
				vent.reactor.on(vent.interface.itemQueued.id, this.queueItem, this);
			},

			stop: function () {
				vent.reactor.off();
			}
		};

		return controller;
	}
);