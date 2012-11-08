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
				var item = null;

				if(options.item)
					item = options.item;
				else if(options.type && options.id)
					item = playlist.findItemById(options.type, options.id);

				if( item ) {
					mediaDriver.play(item); // plays the item

					ui.loadItemToDisplay(item); //display the item in HUD

					vent.reactor.trigger(vent.interface.itemPlayedSuccess.id, item);
				} else {
					// attaches the item to playlist, should also update the view of the playlist
					playlist.addNewItem(options.type, options.id, this.playItem, this);
				}
			},

			cleanUpDisplay: function () {
				ui.cleanUpDisplay();
				this.playNextItem();
			},

			playNextItem: function () {
				var nextItem = playlist.nextItem() || playlist.firstItem();
				
				if(! nextItem ) return;
				
				this.playItem({item: nextItem});
			},

			playPrevItem: function () {
				var prevItem = playlist.prevItem() || playlist.lastItem();

				if(! prevItem) return;

				this.playItem({item: prevItem});
			},

			togglePlayPause: function () {
				if(mediaDriver.isPlaying()) {
					mediaDriver.togglePlayPause();
					ui.togglePlayPauseBtn();
					vent.reactor.trigger(vent.interface.itemPausedSuccess.id, item);
				} else {
					mediaDriver.togglePlayPause();
					ui.togglePlayPauseBtn();
					vent.reactor.trigger(vent.interface.itemPlayedSuccess.id, item);
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

			start: function () {
				vent.reactor.on(vent.interface.itemPlayed.id, this.playItem, this);
				vent.reactor.on(vent.interface.itemFinished.id, this.cleanUpDisplay, this);
				vent.reactor.on(vent.interface.nextBtnPressed.id, this.playNextItem, this);
				vent.reactor.on(vent.interface.prevBtnPressed.id, this.playPrevItem, this);
				vent.reactor.on(vent.interface.playBtnToggled.id, this.togglePlayPause, this);
				vent.reactor.on(vent.interface.playlistWindowToggled.id, this.togglePlaylistWindow, this);
				vent.reactor.on(vent.interface.videoWindowToggled.id, this.toggleVideoWindow, this);
				vent.reactor.on(vent.interface.playlistCleared.id, this.clearPlaylist, this);
				vent.reactor.on(vent.interface.videoFullscreenToggled.id, this.toggleVideoFullScreen, this);
			},

			stop: function () {
				vent.reactor.off();
			}
		};

		return controller;
	}
);