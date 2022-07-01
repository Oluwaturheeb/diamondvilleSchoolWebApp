(function() {
	$('.gallery div').click(function() {
		let src = $(this).find('img').attr('src');
		
		$('.gallery-show').css({'opacity': 1, 'z-index': 2});
		$('.gallery-show .image').attr('src', src);
	});
	
	$('.gallery-show').click(() => {
		$('.gallery-show').css({'opacity': 0, 'z-index': '-1'});
	});
})(jQuery);