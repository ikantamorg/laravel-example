define(
	[
		'dash/vent'
	],
	function (dashVent) {
		var startMediaTriggers = function () {
			$('.songs-list .song-play-btn, .artists-list .play-button').on('click', function () {
				var $listItem = $(this).parent().parent();
				var songId = parseInt($listItem.data('id'));
				dashVent.reactor.trigger(dashVent.interface.itemPlayed.id, {type:'song', id: songId});
			});

			$('.songs-list .add-q-btn a').on('click', function (ev) {
				ev.preventDefault();
				var $listItem = $(this).parent().parent().parent();
				var songId = parseInt($listItem.data('id'));
				dashVent.reactor.trigger(dashVent.interface.itemQueued.id, {type:'song', id: songId});
			});

			$('.videos-list .video-play-btn').on('click', function () {
				var $listItem = $(this).parent().parent();
				var videoId = parseInt($listItem.data('id'));
				dashVent.reactor.trigger(dashVent.interface.itemPlayed.id, {type:'video', id: videoId});
			});

			$('.videos-list .add-q-btn').on('click', function () {
				var $listItem = $(this).parent().parent();
				var videoId = parseInt($listItem.data('id'));
				dashVent.reactor.trigger(dashVent.interface.itemQueued.id, {type:'video', id: videoId});
			});

			var s = '.songs-list .song-play-btn, .artists-list .play-button, .songs-list .add-q-btn a, .videos-list .video-play-btn, .videos-list .add-q-btn';
			$(s).on('dblclick', function (ev) {
				ev.preventDefault();
			});
		};

		return {
			init: function () { 
				startMediaTriggers();
			}
		}
	}
);