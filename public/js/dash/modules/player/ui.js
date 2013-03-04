define(
	[
		'dash/modules/url',
		'./vent',
		'./dom',
		'./ui/domEventBinder'
	],
	function (url, vent, dom, domEventBinder) {
		var multiAnimationHelperFactory = function (cutOff) {
			var count = 0;
			var helper = _.extend({}, Backbone.Events);
			helper.cutOff = cutOff;
			helper.updateCounter = function () {
				if(++count === helper.cutOff)
					helper.trigger('done');
			};

			return helper;
		};

		domEventBinder.run();

		var ui = {
			loadMedia: function (item) {
				if(item.getType() === 'video')
					dom.itemSourceIcon().is(':hidden') && dom.itemSourceIcon().show();
				else
					dom.itemSourceIcon().hide();
								
				dom.songNameDisplay().text(item.getName());
				
				dom.artistNameDisplay().text(item.getArtists().join(', '));
				
				dom.nowPlayingFavoriteBtn().attr({
					href: url('me/favorites/'+item.getType()+'/'+item.getId())
				}).hide();
			},

			cleanUpDisplay: function () {
				dom.itemSourceIcon().hide();
				dom.songNameDisplay().text('');
				dom.artistNameDisplay().text('');
				dom.nowPlayingFavoriteBtn().attr({href: null}).hide();
			},

			togglePlayPauseBtn: function () {

				console.log('here');

				if(dom.playToggleBtn().hasClass('pause'))
					dom.playToggleBtn().removeClass('pause');
				else
					dom.playToggleBtn().addClass('pause');
			},

			togglePlaylistWindow: function (callback) {
				if(dom.videoWindow().height() > 0) {
					return this.toggleVideoWindow(this.togglePlaylistWindow);
				}

				var animeHelper = multiAnimationHelperFactory(2);
				var options = {duration: 150, complete: animeHelper.updateCounter};

				if(dom.playlistWindow().height() > 0) {
					dom.playlistWindow().animate({top: 12, height: 0}, options);
					dom.playlistScreen().animate({height: 0}, options);
				} else {
					dom.playlistWindow().animate({top: -344, height: 355}, options);
					dom.playlistScreen().animate({height: 320}, options);
				}

				if(typeof(callback) === 'function') animeHelper.on('done', callback);
			},

			toggleVideoWindow: function (callback) {
				if(dom.playlistWindow().height() > 0) {
					return this.togglePlaylistWindow(this.toggleVideoWindow);
				}

				var animeHelper = multiAnimationHelperFactory(2);
				var options = {duration: 150, complete: animeHelper.updateCounter};

				if(dom.videoWindow().height() > 0) {
					dom.videoWindow().animate({top: 12, height: 0}, options);
					dom.videoScreen().animate({height: 0}, options);
				} else {
					dom.videoWindow().animate({top: -344, height: 355}, options);
					dom.videoScreen().animate({height: 320}, options);
				}

				if(typeof(callback) === 'function') animeHelper.on('done', callback);
			},

			toggleVideoFullScreen: function () {
				
			},

			trackProgressOfMedia: function (mediaDriver) {
				
			}
		};

		return ui;
	}
);