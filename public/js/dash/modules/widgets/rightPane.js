define(['dash/modules/ajax'], function (ajax) {

  var urisPatternsWithoutRightPane = [
    /^\/dashboard\/(artists|events)\/profile\/\S+$/i,

  ];

  return {
    pageHasRightPane: function (uri) {
      var i = 0,
          l = urisPatternsWithoutRightPane.length
      ;

      for (;i<l;i++) {
        var p = urisPatternsWithoutRightPane[i];
        if(p.test(uri)) return false;
      }

      return true;
    },

    load: function () {
      var $holder = $('#rightPaneHolder');
      ajax.fetchWidget('right_pane', function (html) {
        $holder.html(html);
      });

    }
  }

})