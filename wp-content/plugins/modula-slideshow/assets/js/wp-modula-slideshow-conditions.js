(function ($) {
	"use strict"

	var modulaSlideshowConditions = Backbone.Model.extend({

		initialize: function (args) {

			var rows = jQuery('.modula-settings-container tr[data-container]');
			var tabs = jQuery('.modula-tabs .modula-tab');
			this.set('rows', rows);
			this.set('tabs', tabs);

			this.initEvents();
			this.initValues();

		},

		initEvents: function () {

			this.listenTo(wp.Modula.Settings, 'change:enable_slideshow', this.changeSlideshow);
		},

		initValues: function () {
			this.changeSlideshow(false, wp.Modula.Settings.get('enable_slideshow'));
		},

		changeSlideshow: function (settings, value) {

			var rows = this.get('rows');
			if ( '1' != value ) {
				rows.filter('[data-container="enable_autoplay"],[data-container="pause_on_hover"],[data-container="slideshow_speed"]').hide();
			} else {
				rows.filter('[data-container="enable_autoplay"],[data-container="pause_on_hover"],[data-container="slideshow_speed"]').show();
			}

		},

	});

	$(document).ready(function () {
		new modulaSlideshowConditions();
	});
})(jQuery);