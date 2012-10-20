define(['./player/vent'], function (vent, controls) {
	
	var Player = function () {
		this.$el = $('#player');
		this.playControls = {};
		
		this.playControls.$el = this.$el.find('.control');
		this.playControls.$playBtn = this.playControls.$el.find('.play');
		
	}

});