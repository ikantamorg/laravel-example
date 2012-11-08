define(
	[
		'dash/modules/urlGen',
		'./vent',
		'./dom',
		'./ui/domEventBinder'
	],
	function (urlGen, vent, dom, domEventBinder) {
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
			loadItemToDisplay: function (item) {
				if(item.type === 'video' && dom.itemSourceIcon().is(':hidden'))
					dom.itemSourceIcon().hide();

				dom.songNameDisplay().text(item.model.name);
				
				dom.artistNameDisplay().text(_.map(item.model.artists, function (a) { return a.name; }).join(', '));
				
				dom.nowPlayingFavoriteBtn().attr({
					href: urlGen('me/favorites/'+item.type+'/'+item.model.id)
				}).hide();
			},

			cleanUpDisplay: function () {
				dom.itemSourceIcon().hide();
				dom.songNameDisplay().text('');
				dom.artistNameDisplay().text('');
				dom.nowPlayingFavoriteBtn().attr({href: null}).hide();
			},

			togglePlayPauseBtn: function () {
				dom.playToggleBtn().hasClass('pause') && dom.playToggleBtn().removeClass('pause');
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
					dom.playlistWindow().animate({top: -339, height: 350}, options);
					dom.playlistWindow().animate({height: 315}, options);
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
					dom.videoWindow().animate({height: 0}, options);
				} else {
					dom.videoWindow().animate({top: -339, height: 350}, options);
					dom.videoWindow().animate({height: 315}, options);
				}

				if(typeof(callback) === 'function').animeHelper.on('done', callback);
			}
		};
	}
);