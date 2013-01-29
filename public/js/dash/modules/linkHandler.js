define(
  [
    'dash/vent',
    './linkHandler/driverFactory'
  ],

  function (dashVent, driverFactory) {

    var process = function ($anchor) {
      driverFactory.make($anchor.data('driver')).handleClick($anchor);
    };

    return {
      init: function () {
        $('body').on('click', 'a', function (ev) {
          var $anchor = $(this);

          if($anchor.data('driver')) {
            ev.preventDefault();
            process($anchor);
          }
        });
      }
    };
  }
);