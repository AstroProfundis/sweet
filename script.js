$(document).ready(function() {

	var timeline = $('#timeline'),
		source = $('#entry-template').html(),
		template = Handlebars.compile(source),
		tweet = null;

	var	filter_text = function(input) {
		input = input.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig,"<a href='$1'>$1</a>");
		input = input.replace(/(^|\s)@(\w+)/g, "$1<a href='https://twitter.com/$2'>@$2</a>");
		input = input.replace(/(^|\s)#(\w+)/g, "$1<a href='https://search.twitter.com/search?q=%23$2'>#$2</a>");
		return input;
	};

	var load_more = function() {
		$(window).unbind('scroll.sweet');
		
		$.ajax({
			url: 'fetch.php',
			data: {
				max_id: $("#timeline li:last-child").data('id')
			},
			dataType: 'json',
			success: function(json) {
				if (json) {
					tweet = template(json);
					timeline.append((tweet));
				} else {
					// $spinner.html('<p>No more posts to show.</p>');
				}
				
				$(window).bind('scroll.sweet', scroll_event);
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