define(function () {
	return {
		interface: {
			itemPlayed: {id: 'itemPlayed'},
			itemPlayedSuccess: {id: 'itemPlayedSuccess'},
			
			itemPaused: {id: 'itemPaused'},
			itemPausedSuccess: {id: 'itemPausedSuccess'},
			
			itemQueued: {id: 'itemQueued'},
			itemQueuedSuccess: {id: 'itemQueuedSuccess'},
			
			itemRemovedFromQueue: {id: 'itemRemovedFromQueue'},
			itemRemovedFromQueueSuccess: {id: 'itemRemovedFromQueueSuccess'},
			
			itemFinished: {id: 'itemFinished'},

			itemFavorited: {id: 'itemFavorited'},
			itemFavoritedSuccess: {id: 'itemFavoritedSuccess'},
			
			itemUnfavorited: {id: 'itemUnfavorited'},
			itemUnfavoritedSuccess: {id: 'itemUnfavoritedSuccess'},
			
			/////////////

			playlistWindowToggled: {id: 'playlistWindowToggled'},
			videoWindowToggled: {id: 'videoWindowToggled'},

			playlistCleared: {id: 'playlistCleared'},

			videoFullScreenToggled: {id: 'videoFullScreenToggled'},

			nextBtnPressed: {id: 'nextBtnPressed'},
			prevBtnPressed: {id: 'prevBtnPressed'},
			playBtnToggled: {id: 'playBtnToggled'},

			//some more volume-bar related stuff
			//some volume handle related stuff
			
			//some progress-bar related stuff
			//some progress handle related stuff

			//some timer related stuff
		},

		reactor: _.extend({}, Backbone.Events)
	};
});