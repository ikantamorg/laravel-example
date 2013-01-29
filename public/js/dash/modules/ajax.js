define(
  [
    'dash/vent',
    './errorHandler',
    './url',
    './widgets/util/stateArgs'
  ],
  function (dashVent, errorHandler, url, stateArgs) {

    var doAjax = function (options, callback, ctx) {
      options.success = function (data) {
        ctx ? callback.call(ctx, data) : callback(data);
      };

      options.error = function (data) {
        console.log(data);
      }

      $.ajax(options);
    }

    return {
      getPlaylistItems: function (callback, ctx) {
        doAjax({
          url: url('player/playlist'),
          dataType: 'json'
        }, callback, ctx);
      },

      addItemToPlaylist: function (type, id, callback, ctx) {
        doAjax({
          url: url('player/playlist/item/' + type + '/' + id),
          dataType: 'json',
          type: 'POST'
        }, callback, ctx);
      },

      removeItemFromPlaylist: function (index, callback, ctx) {
        doAjax({
          url: url('player/playlist/item/' + index),
          dataType: 'json',
          type: 'DELETE'
        }, callback, ctx);
      },

      fetchPage: function (url, callback, ctx) {
        doAjax({
          url: url,
          dataType: 'html',
          type: 'GET'
        }, callback, ctx);
      },

      fetchWidget: function (widget, callback, ctx) {
        doAjax({
          url: url('dashboard/widgets/' + widget),
          dataType: 'html',
          type: 'GET',
          data: stateArgs.get()
        }, callback, ctx)
      }
    };
  }
);