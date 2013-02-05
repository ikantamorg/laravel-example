define(
  [
    './modules/linkHandler',
    './modules/player',
    './modules/router',
    './modules/widgets/leftPane',
    './modules/triggers'
  ],
  function (linkHandler, player, router, leftPane, triggers) {

    return {
      start: function () {
        linkHandler.init();
        player.init();
        triggers.init();
      }
    };
  }
);