define(
  [
    './drivers/pageChanger',
    './drivers/favoriter',
  ],
  
  function (pageChanger, favoriter) {

    var drivers = {
      pageChanger: pageChanger,
      favoriter: favoriter
    };

    return {
      make: function (driverName) {
        return drivers[driverName];
      }
    }
  }
)