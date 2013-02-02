define(function () {

  return {
    get: function () {
      return {
        uri: window.location.pathname.slice(1),
        params: window.encodeURI(window.location.search.slice(1))
      };
    }
  };

})