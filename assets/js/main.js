
var Main = (function ($) {
	return {
		myFunction: function () {

		},
		initMain: function () {
			$(document).ready(function () {
				Main.myFunction();
			})
		}
	};
// Pass in jQuery.
})(jQuery);

Main.initMain();