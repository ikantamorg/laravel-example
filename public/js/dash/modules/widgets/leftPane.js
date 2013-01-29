define(['dash/modules/ajax'], function (ajax) {

  var $leftPane = $('#content .row.left-pane');

  return {
    load: function () {
      ajax.fetchWidget('left_pane', function (data) {
        var $newLeftPane = $(data);
        $leftPane.replaceWith($newLeftPane);
        $leftPane = $newLeftPane;
      });
    }
  }

});