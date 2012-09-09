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
			complete: function(XMLHttpRequest, textStatus) {
				
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

	$('#more').click(function() {
		alert('100');
	});

	$('#more').on('click', function(e) {
		alert('111');
		// load_more();
		// return false;
	});

	$('#loading').on('click', function(e) {
		alert('222');
		// ajax.abort();
	});

	load_more();

});