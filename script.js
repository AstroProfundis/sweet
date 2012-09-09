$(document).ready(function() {

	var timeline = $('#timeline'),
		loader = $('#loader'),
		source = $('#entry-template').html(),
		template = Handlebars.compile(source),
		winheight = $(window).height();

	var load_more = function() {

		$(window).off('scroll.sweet');

		$.ajax({
			url: 'fetch.php',
			data: {
				max_id: $('#timeline li:last-child').data('id')
			},
			dataType: 'json',
			beforeSend: function(XMLHttpRequest) {
				loader.html('<span class="loading" id="loading">Loading</span>');
			},
			success: function(json) {
				if (json && json.length > 0) {
					timeline.append(template(json));
					loader.html(null);
					$(window).bind('scroll.sweet', scroll_event);
				} else {
					loader.html('No more tweets to show');
				}
			},
			error: function(XMLHttpRequest, textStatus) {
				loader.html('Error: ' + $.parseJSON(XMLHttpRequest.responseText).error);
			}
		});

	}

	var scroll_event = function() {

		var wintop = $(window).scrollTop(),
			docheight = $(document).height();

		if ((wintop / (docheight - winheight)) > 0.8) {
			load_more();
		}

	};

	$(window).on('scroll.sweet', scroll_event);

	load_more();

});