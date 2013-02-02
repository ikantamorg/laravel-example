define(
  [
    './pageChanger/dom',
    'dash/modules/ajax',
    'dash/modules/router',
    'dash/modules/widgets/rightPane',
    'dash/modules/widgets/leftPane'
  ],
  function (dom, ajax, router, rightPaneWidget, leftPaneWidget) {
    var baseUrl = location.protocol + '//' + location.host;

    var handleClick = function ($a) {
      var targetUrl = $a.attr('href'),
          targetUri = targetUrl.slice(baseUrl.length)
      ;

      router.navigate(targetUri);
      leftPaneWidget.load();

      ajax.fetchPage(targetUrl, function (html) {
        if(rightPaneWidget.pageHasRightPane(targetUri)) {
          dom.bodyHolder().setupWithRightPane();
          dom.bodyHolder().html(html);
        } else {
          dom.bodyHolder().setupWithoutRightPane().html(html);
        }
      })
    };


    return {
      handleClick: handleClick
    };
  }
);