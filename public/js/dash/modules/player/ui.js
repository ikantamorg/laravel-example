define(
	[
		'dash/modules/urlGen',
		'./vent',
		'./dom',
		'./ui/domEventBinder'
	],
	function (urlGen, vent, dom, domEventBinder) {
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

			togglePlaylistWindow: function () {
				if(dom.videoWindow().height() === 0) {
					dom.playlistWindow().animate({'top': '-339px', 'height': '350px'}, 150);
					dom.playlistScreen().animate({'top': '-339px', 'height': '315px'}, 150);
				}
			},

			toggleVideoWindow: function () {

			}
		}
	}
);