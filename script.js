$(document).ready(function() {

	var timeline = $('#timeline'),
		loading = $('#loading'),
		source = $('#entry-template').html(),
		template = Handlebars.compile(source),
		tweet = null;

	var load_more = function() {
		$(window).unbind('scroll.sweet');

		$.ajax({
			url: 'fetch.php',
			data: {
				max_id: timeline.children('li:last-child').data('id')
			},
			dataType: 'json',
			success: function(json) {
				if (json && json.length > 0) {
					tweet = template(json);
					timeline.prepend(tweet);

					$(window).bind('scroll.sweet', scroll_event);
				} else {
					loading.html('No more tweets to show');
				}
			}
		});
	}

	var scroll_event = function() {
		var wintop = $(window).scrollTop(),
			docheight = $(document).height(),
			winheight = $(window).height(),
			scrolltrigger = 0.95;

		if ((wintop / (docheight - winheight)) > scrolltrigger) {
			load_more();
		}
	};

	$(window).bind('scroll.sweet', scroll_event);

	load_more();

});