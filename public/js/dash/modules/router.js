define([], function () {
 var h = new Backbone.History;
 h.start({pushState: true});
 return h;
});