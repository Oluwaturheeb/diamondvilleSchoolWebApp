(function ($) {
	var info = $('.exam-info');
	var q = loop.question;
	var a = loop.a;
	var b = loop.b;
	var c = loop.c;
	var d = loop.d;
	var count = q.length;
	var next = 1;
	var init = 0;
	var arr = [];
	$('.e-question span').html(q[0]);
	$('.e-a span').html(a[0]);
	$('.e-b span').html(b[0]);
	$('.e-c span').html(c[0]);
	$('.e-d span').html(d[0]);
	$('.my-3 small').text('Question No. ' + next +' of ' + count);
	
	$('.control-btn button').click(function () {
		var val = $('.option input:checkbox:checked').val();
		if(!v.empty(val)){
			// this empty the info if error
			info.html('');

			// this updates the question and options
			$('.e-question span').html(q[0 + next]);
			$('.e-a span').html(a[0 + next]);
			$('.e-b span').html(b[0 + next]);
			$('.e-c span').html(c[0 + next]);
			$('.e-d span').html(d[0 + next]);

			// this uncheck the last check box option
			$('.option input:checkbox').prop('checked', false);
			$('.option div').removeClass('active');

			// this insert all checked option into an array
			if (arr.length != count) {
				arr.push(val);
			}

			if (arr.length == count) {
				$(this).html("Submit");
				var con = confirm('You are about to submit!');
				if (con) {
					ajaxReq();
				}
			}
			if (next != count) {
				next++;
			}

			$('.my-3 small').text('No ' + next +' of ' + count);
			if (next == count)
				$(this).html("Submit");
		} else {
			info.html('Select an answer!');
		}
	});
	
	$('.exam .option div').click(function(){
		var id = $(this).attr('id');
		
		$(this).addClass('active').siblings().removeClass('active');
		$(this).children('input').prop('checked', true);
		$(this).siblings().children('input').prop('checked', false);
	});
	
	// make sure to change the time of auto submit
 setTimeout(() => {
 		alert('Time up!');
 		ajaxReq();
 }, 60 * 60 * 1000);
	
/*
var isSubmitting = false

$('form').submit(function(){
	isSubmitting = true
})

$('form').data('initial-state', $('form').serialize());

$(window).on('beforeunload', function() {
	if (!isSubmitting && $('form').serialize() != $('form').data('initial-state')) {
		return 'You have unsaved changes which will not be saved.'
 }*
 alert()
});
	*/
	
	function ajaxReq() {
		$.ajax({
			data: {'exam-ans': arr, type: 'exam-submit'},
			dataType: 'json',
			beforeSend: () => {
				info.html('Connecting to the server...');
			},
			success: e => {
				if (e.msg == 'ok') {
					info.html("Submitted");
					v.redirect();
				} else {
					info.html(e);
				}
			},
			error: e => {v.dError(e, true)
				info.html(e);
			}
		});
	}
})(jQuery);