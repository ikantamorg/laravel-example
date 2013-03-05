define(function () {
	var Item = Backbone.Model.extend({

		getType: function () {
			return this.get('type');
		},

		getName: function () {
			return this.get('model').name;
		},

		getId: function () {
			return this.get('model').id;
		},

		getArtists: function () {
			return _.map(this.get('model').artists, function (a) { return a.name; });
		},

    getDuration: function () {
      return parseFloat(this.get('model').duration);
    }

	});

	return Item;
});