define(
	[
		'dash/vent'
	],
	function (dashVent) {
		var startMediaTriggers = function () {
			$('#content').on('click', '.songs-list .song-play-btn, .artists-list .play-button', function () {
				var $listItem = $(this).parent().parent();
				var songId = parseInt($listItem.data('id'));
        console.log('here');
				dashVent.reactor.trigger(dashVent.interface.itemPlayed.id, {type:'song', id: songId});
			});

			$('#content').on('click', '.songs-list .add-q-btn a', function (ev) {
				ev.preventDefault();
				var $listItem = $(this).parent().parent().parent();
				var songId = parseInt($listItem.data('id'));
				dashVent.reactor.trigger(dashVent.interface.itemQueued.id, {type:'song', id: songId});
			});

			$('#content').on('click', '.videos-list .video-play-btn', function () {
				var $listItem = $(this).parent().parent();
				var videoId = parseInt($listItem.data('id'));
				dashVent.reactor.trigger(dashVent.interface.itemPlayed.id, {type:'video', id: videoId});
			});

			$('#content').on('.videos-list .add-q-btn', function () {
				var $listItem = $(this).parent().parent();
				var videoId = parseInt($listItem.data('id'));
				dashVent.reactor.trigger(dashVent.interface.itemQueued.id, {type:'video', id: videoId});
			});

			var s = '.songs-list .song-play-btn, .artists-list .play-button, .songs-list .add-q-btn a, .videos-list .video-play-btn, .videos-list .add-q-btn';
			$('#content').on('dblclick', s, function (ev) {
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