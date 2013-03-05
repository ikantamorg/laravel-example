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

    var timeObjectFactory = function (timeInSeconds) {
      return {
        min : Math.floor(timeInSeconds / 60),
        sec: Math.round(timeInSeconds - Math.floor(timeInSeconds / 60) * 60)
      }
    }

		domEventBinder.run();

		var ui = {
      media: null,

			loadMedia: function (item) {
        if(this.media) {
          this.media.off('progress', this.trackProgressOfMedia, this);
          this.media.off('played', this.setPlayingState, this);
        }

        this.media = item;

        this.media.on('progress', this.trackProgressOfMedia, this);
        this.media.on('played', this.setPlayingState, this);

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

      setPlayingState: function () {
        if(! dom.playToggleBtn().hasClass('pause')) {
          dom.playToggleBtn().addClass('pause');
        }
      },

			cleanUpDisplay: function () {
				dom.itemSourceIcon().hide();
				dom.songNameDisplay().text('');
				dom.artistNameDisplay().text('');
				dom.nowPlayingFavoriteBtn().attr({href: null}).hide();
			},

			togglePlayPauseBtn: function () {

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

			trackProgressOfMedia: function (data) {
		    if(! this.media	) return;

        dom.streamingBar().width(100 * data.streamed + '%');
        dom.progressBar().width(100 * data.played + '%');
        dom.progressHandle().css('left', 100 * data.played + '%');

        var timeDone = timeObjectFactory(data.played * data.duration);
        var totalTime = timeObjectFactory(data.duration)
      

        //console.log(timeDone, totalTime);

        dom.timeDoneDisplay().text(timeDone.min + ':' + timeDone.sec);
        dom.timeLeftDisplay().text(totalTime.min + ':' + totalTime.sec);

			}
		};

		return ui;
	}
);