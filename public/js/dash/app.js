define(
  [
    './modules/linkHandler',
    './modules/player',
    './modules/router',
    './modules/widgets/leftPane'
  ],
  function (linkHandler, player, router, leftPane) {

    return {
      start: function () {
        linkHandler.init();
        player.init();
      }
    };
  }
);