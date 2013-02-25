define(['./List', './ItemView'], function (List, ItemView) {
	var ListView = Backbone.View.extend({
		list: null,
		el: null,

		itemViews: [],

		initialize: function (options) {
			this.$el = options.$el;
			this.list = options.list;

			this.list.on('add remove reset', this.render, this);
		},

		render: function () {
			this.$el.html('');
			_.each(this.itemViews, function (view) { view.off(); });
      this.itemViews = [];
			
			this.list.each(function (item) {
				this.itemViews.push(new ItemView({item: item}));
			}, this);

			_.each(this.itemViews, function (view) {
				this.$el.append(view.render());
			}, this);
		}
	});

	return ListView;
});