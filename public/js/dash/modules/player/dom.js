define(
	[],
	function () {

		var elements = {
			domContainer: null,
			playerHolder: null,

			prevBtn: null,
			nextBtn: null,
			playToggleBtn: null,

			displayBox: null,

			songNameDisplay: null,
			artistNameDisplay: null,

			timeDoneDisplay: null,
			timeLeftDisplay: null,

			streamingBar: null,
			progressBar: null,
			progressHandle: null,

			volumeBar: null,
			volumeHandle: null,

			nowPlayingFavoriteBtn: null,
			nowPlayingFBShareBtn: null,
			nowPlayingTweetBtn: null,

			playlistWindowToggleBtn: null,
			videoWindowToggleBtn: null,


			playlistWindow: null,
			playlistScreen: null,
			playlistHolder: null,
			playlistCollapseBtn: null,
			playlistClearBtn: null,

			videoWindow: null,
			videoScreen: null,
			videoCollapseBtn: null,
			videoFullScreenBtn: null,

			itemSourceIcon: null
		};

		var setUIElement = function (holder, $element) {
			elements[holder] = $element.length > 0 ? $element : null;
		};

		return {
			domContainer: function () {
				if(elements.domContainer) return elements.domContainer;
				setUIElement('domContainer', $('#player'));
				return elements.domContainer;
			},

			playerHolder: function () {
				if(elements.playerHolder) return elements.playerHolder;
				setUIElement('playerHolder', this.domContainer().children(':first').children(':first'));
				return elements.playerHolder;
			},

			prevBtn: function () {
				if(elements.prevBtn) return elements.prevBtn;
				setUIElement('prevBtn', this.playerHolder().find('.control .previous'));
				return elements.prevBtn;
			},

			nextBtn: function () {
				if(elements.nextBtn) return elements.nextBtn;
				setUIElement('nextBtn', this.playerHolder().find('.control .forward'));
				return elements.nextBtn;
			},

			playToggleBtn: function () {
				if(elements.playToggleBtn) return elements.playToggleBtn;
				setUIElement('playToggleBtn', this.playerHolder().find('.control .play'));
				return elements.playToggleBtn;
			},

			displayBox: function () {
				if(elements.displayBox) return elements.displayBox;
				setUIElement('displayBox', this.playerHolder().find('.display'));
				return elements.displayBox;
			},

			songNameDisplay: function () {
				if(elements.songNameDisplay) return elements.songNameDisplay;
				setUIElement('songNameDisplay', this.displayBox().find('.song-name'));
				return elements.songNameDisplay;
			},

			artistNameDisplay: function () {
				if(elements.artistNameDisplay) return elements.artistNameDisplay;
				setUIElement('artistNameDisplay', this.displayBox().find('.artist-name'));
				return elements.artistNameDisplay;
			},

			timeDoneDisplay: function () {
				if(elements.timeDoneDisplay) return elements.timeDoneDisplay;
				setUIElement('timeDoneDisplay', this.displayBox().find('.time-done'));
				return elements.timeDoneDisplay;
			},

			timeLeftDisplay: function () {
				if(elements.timeLeftDisplay) return elements.timeLeftDisplay;
				setUIElement('timeLeftDisplay', this.displayBox().find('.time-left'));
				return elements.timeLeftDisplay;
			},

			streamingBar: function () {
				if(elements.streamingBar) return elements.streamingBar;
				setUIElement('streamingBar', this.displayBox().find('.stream .stream-1'));
				return elements.streamingBar;
			},

			progressBar: function () {
				if(elements.progressBar) return elements.progresssBar;
				setUIElement('progresssBar', this.displayBox().find('.stream .stream-2'));
				return elements.progresssBar;
			},

			progressHandle: function () {
				if(elements.progressHandle) return elements.progressHandle;
				setUIElement('progressHandle', this.displayBox().find('.stream .handle'));
				return elements.progressHandle;
			},

			volumeBar: function () {
				if(elements.volumeBar) return elements.volumeBar;
				setUIElement('volumeBar', this.displayBox().find('.volume .stream1'));
				return elements.volumeBar;
			},

			volumeHandle: function () {
				if(elements.volumeHandle) return elements.volumeHandle;
				setUIElement('volumeHandle', this.displayBox().find('.volume .handle'));
				return elements.volumeHandle;
			},

			nowPlayingFavoriteBtn: function () {
				if(elements.nowPlayingFavoriteBtn) return elements.nowPlayingFavoriteBtn;
				setUIElement('nowPlayingFavoriteBtn', this.displayBox().find('.socials .fav a'));
				return elements.nowPlayingFavoriteBtn;
			},

			nowPlayingFBShareBtn: function () {
				if(elements.nowPlayingFBShareBtn) return elements.nowPlayingFBShareBtn;
				setUIElement('nowPlayingFBShareBtn', this.displayBox().find('.socials .facebook a'));
				return elements.nowPlayingFBShareBtn;
			},

			nowPlayingTweetBtn: function () {
				if(elements.nowPlayingTweetBtn) return elements.nowPlayingTweetBtn;
				setUIElement('nowPlayingTweetBtn', this.displayBox().find('.socials .twitter a'));
				return elements.nowPlayingTweetBtn;
			},

			playlistWindowToggleBtn: function () {
				if(elements.playlistWindowToggleBtn) return playlistWindowToggleBtn;
				setUIElement('playlistWindowToggleBtn', this.playerHolder().find('.control .playlist'));
				return elements.playlistWindowToggleBtn;
			},

			videoWindowToggleBtn: function () {
				if(elements.videoWindowToggleBtn) return elements.videoWindowToggleBtn;
				setUIElement('videoWindowToggleBtn', this.playerHolder().find('.control .video'));
				return elements.videoWindowToggleBtn;
			},

			playlistWindow: function() {
				if(elements.playlistWindow) return elements.playlistWindow;
				setUIElement('playlistWindow', this.playerHolder().find('.frame.playlist'));
				return elements.playlistWindow;
			},

			playlistScreen: function () {
				if(elements.playlistScreen) return elements.playlistScreen;
				setUIElement('playlistScreen', this.playlistWindow().find('.screen'));
				return elements.playlistScreen;
			},

			playlistHolder: function () {
				if(elements.playlistHolder) return elements.playlistHolder;
				setUIElement('playlistHolder', this.playlistScreen().find('.playlist'));
				return elements.playlistHolder;
			},

			playlistCollapseBtn: function () {
				if(elements.playlistCollapseBtn) return elements.playlistCollapseBtn;
				setUIElement('playlistCollapseBtn', this.playlistWindow().find('.head .collapse'));
				return elements.playlistCollapseBtn;
			},

			playlistClearBtn: function () {
				if(elements.playlistClearBtn) return elements.playlistClearBtn;
				setUIElement('playlistClearBtn', this.playlistWindow().find('.head .clear'));
			},

			videoWindow: function () {
				if(elements.videoWindow) return elements.videoWindow;
				setUIElement('videoWindow', this.videoWindow().find('.frame.video'));
				return elements.videoWindow;
			},

			videoScreen: function () {
				if(elements.videoScreen) return elements.videoScreen;
				setUIElement('videoScreen', this.videoWindow().find('.screen'));
				return elements.videoScreen;
			},

			videoCollapseBtn: function () {
				if(elements.videoCollapseBtn) return elements.videoCollapseBtn;
				setUIElement('videoCollapseBtn', this.videoWindow.find('.head .collapse'));
				return elements.videoCollapseBtn;
			},

			videoFullScreenBtn: function () {
				if(elements.videoFullScreenBtn) return elements.videoFullScreenBtn;
				setUIElement('videoFullScreenBtn', this.videoWindow.find('.head .collapse'));
				return elements.videoFullScreenBtn;
			},

			itemSourceIcon: function () {
				if(elements.itemSourceIcon) return elements.itemSourceIcon;
				setUIElement('itemSourceIcon', this.playerHolder().find('.source'));
				return elements.itemSourceIcon;
			}
		}
	}
);