define(
	[
		'./Item',
		'./templates',
		'dash/modules/player/vent',
	],
	function (Item, templates, vent) {
		var ItemView = Backbone.View.extend({
			tagName: 'div',
			className: 'row list-item',

			item: null,

			events: {
				'click .close': 'deleteItem',
				'click .playBtn': 'playItem',
			},

			initialize: function (options) {
				this.item = options.item;
			},

			deleteItem: function (ev) {
				vent.reactor.trigger(vent.interface.itemRemovedFromQueue.id, this.item);
			},

			playItem: function (ev) {
				vent.reactor.trigger(vent.interface.itemPlayed.id, {item: this.item});
			},

			_template: null,
			template: function () {
				if(this._template) return this._template;
				if(this.item.get('type') === 'song') this._template = templates.songItemTmpl;
				if(this.item.get('type') === 'video') this._template = templates.videoItemTmpl;
				return this._template;
			},

			render: function () {
				return this.$el.append(this.template()(this.item.toJSON()));
			},

			off: function () {
				this.undelegateEvents();
			}
		});

		return ItemView;
	}
);