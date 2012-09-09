$(document).ready(function() {

	var timeline = $('#timeline'),
		loader = $('#loader'),
		ajax,
		source = $('#entry-template').html(),
		template = Handlebars.compile(source),
		tweet = null,
		winheight = $(window).height();

	var load_more = function() {

		$(window).unbind('scroll.sweet');

		ajax = $.ajax({
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
					tweet = template(json);
					timeline.append(tweet);
					loader.html(null);
					$(window).bind('scroll.sweet', scroll_event);
				} else {
					loader.html('No more tweets to show');
				}
			},
			error: function(XMLHttpRequest, textStatus) {
				console.log(XMLHttpRequest);



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