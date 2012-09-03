$(document).ready(function() {

	var timeline = $('.timeline'),
		source = $('#entry-template').html(),
		template = null,
		tweet = null,
		result = [];

	function loadMore() {
		$(window).unbind('scroll.sweet');
		
		$.ajax({
			url: 'fetch.php',
			dataType: 'json',
			success: function(json) {
				if (json) {
					template = Handlebars.compile(source);

					for (var i = 0; i < json.length; i++) {
						tweet = template(json[i]);

						result.push(tweet);
					}

					timeline.append(result.join(''));
				} else {
					// $spinner.html('<p>No more posts to show.</p>');
				}
				
				$(window).bind('scroll.sweet', scrollEvent);
			}
		});
	}
	
	function scrollEvent() {
		var wintop = $(window).scrollTop(),
			docheight = $(document).height(),
			winheight = $(window).height(),
			scrolltrigger = 0.95;

		if ((wintop / (docheight - winheight)) > scrolltrigger) {
			loadMore();
		}
	}

	$(window).bind('scroll.sweet', scrollEvent);

});