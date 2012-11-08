define(function () {
	return {
		interface: {
			itemPlayed: {id: 'songPlayed'},
			itemPlayedSuccess: {id: 'songPlayedSuccess'},
			itemPaused: {id: 'songPaused'},
			itemPausedSuccess: {id: 'songPausedSuccess'},
			itemRemovedFromQueue: {id: 'songRemovedFromQueue'},
			itemRemovedFromQueueSuccess: {id: 'songRemovedFromQueueSuccess'},
			itemFinished: {id: 'songFinished'}
			itemFavorited: {id: 'songFavorited'},
			itemFavoritedSuccess: {id: 'songFavoritedSuccess'},
			
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