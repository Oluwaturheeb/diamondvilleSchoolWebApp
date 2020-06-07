$(document).ready(function () {
	/* default js */
	$.ajaxSetup({
		url: 'ajax',
		dataType: 'json',
		type: 'post'
	});
	
	$('input, select, textarea').on({
        'mouseover': function(){
            $(this).prev('label').slideDown(500);
        },
        'keyup': () => {
            $(this).prev('label').slideDown(500);
        }
    });

	$(".auth a").click(function(e) {
		e.preventDefault();
		var id = $(this).attr("class");

		$('.info').empty();
		$(".auth-content #" + id).show().siblings("div").hide();
	});

	$(".auth form").submit(function (e) {
		e.preventDefault();

		var info = $('.info');
		v.autoForm(this);

		if (v.check()) {
			info.html(v.thrower()).css({'color': '#b28200', 'font-style': 'oblique'});
		} else {
			$.ajax({
				data: v.auto,
				beforeSend: () => {
					info.html("Connecting to the server...");
				},
				success: e => {
					info.empty();

					if (e.msg == 'ok') {
						$(this).children('#captcha').empty();
						info.html('You are logged!').css({"color": "#36a509"});
						v.redirect(e.type);
					} else if (e.msg == 'captcha') {
						$(this).children('#captcha').html(e.captcha);
					} else if (e.msg == "change") {
						$('.auth .info').empty();
						$(".auth-content #chpwd").show().siblings().hide();
						$('#chpwd .days').html("Its been <b>" + e.days + "days</b> since you last change your password!");
					} else {
						info.html(e.msg).css({'color': '#d80808', 'font-style': 'oblique'});
					}
				}
			});
		}
	});

	$('.skip').click(function(e) {
		e.preventDefault();

		v.redirect('/index');
	});
	
	/* ends here */
	
	// nav control
	
	$('.search, span.close').click(function(e) {
			e.preventDefault();

			$('#search, .links').toggle();
		});
		$('.dp-menu').click(() => {

			if ($('.dp-menu').hasClass('active')) {
				$('.dp-link').css({'margin-left': 0}).show();

				$('.dp-menu').removeClass('active');
				$('.container').css({
					'margin-left': '10rem'
				});
				$('footer').css({
					'margin-left': '10rem'
				});
			} else {
				$('.dp-link').hide();

				$('.dp-menu').addClass('active')
				$('.container, footer').css({
					'margin-left': 'auto'
				});
			}
		});
		
		$('.action form').submit(function (e) {
			e.preventDefault();
			var info = $('.info');
			v.autoForm(this);
			if (v.check()) {
				info.html(v.thrower());
			} else {
				v.withAuto()
			}
		});

		$('.report form').change(function(e) {
			e.preventDefault();

			var info = $('.info');
			v.autoForm(this);
			if (v.check()) {
				info.html(v.thrower());
			} else {
				v.withAuto();
			}
		});

	// setting academy session
	
	$('.check2radio').change(function () {
		v.autoForm($(this).parent('form'));

		if (v.check()) {
			alert(v.thrower());
		} else {
			v.withAuto();
		}
	});

	$('.check2radio').click(function(e) {
		$(this).addClass('active').children('input').prop('checked', true)
		$(this).siblings('div').removeClass('active').children('input').prop('checked', false);
	});

	$('a.details').click(function (e) {
		e.preventDefault();

		var data = {"profile": $(this).attr('href').split("/")[1]};

		$.ajax({
			data : data,
			beforeSend: () => {
				$('.hidden').css({display: 'grid'});
			}, 
			success: e => {
				if (e.msg == "ok") {
					alert(e.payLoad);
				} else {
					alert(e.msg);
				}
			}
		});
	});

	$('a.edit').click(function(e) {
		e.preventDefault();

		var tt = $(this).attr("href").substring(1);
		$('.action .' + tt).show().siblings().hide();
	});

	$('.classes').change(function(e) {
		var val = $(this).val();

		if (typeof val == 'string') {
			if (val.substring(0, 3) == "Sss")
				$(this).parent("div.form-group").next('div').css({display: 'block'});
			else 
				$(this).parent("div.form-group").next('div').css({display: 'none'});
		} else {
			val.forEach(e => {
				if (e.substring(0, 3) == "Sss")
					$(this).parent("div.form-group").next('div').css({display: 'block'});
				else 
					$(this).parent("div.form-group").next('div').css({display: 'none'});
			});
		}
	});
	
	// setting 
	
		$('#set').keyup(() => {
		$('.form-question').empty();
		var num = v.getInput('#set');
		var c = 1;
		for (var i = 0; i < num; i++) {
			$('.form-question').append('<div class="h4 my-3">Question ' + c + '</div><div class="form-group">\
						<label for="question-' + c + '">Question</label>\
						<input type="text" name="question[]" id="question-' + c + '" class="form-control" placeholder="Enter question..." autocomplete="off">\
					</div>\
					<div class="form-group">\
						<label for="ans-' + c + '">Answer</label>\
						<select name="answer[]" id="ans-' + c + '" class="form-control">\
							<option value="">Select answer</option>\
							<option>A</option>\
							<option>B</option>\
							<option>C</option>\
							<option>D</option>\
						</select>\
					</div></div>\
					<div class="form-group">\
						<label for="opt-a-' + c + '">Option a</label>\
						<input type="text" name="opt_a[]" id="opt-a-' + c + '" class="form-control" placeholder="Enter option..." autocomplete="off">\
					</div>\
					<div class="form-group">\
						<label for="opt-b-' + c + '">Option b</label>\
						<input type="text" name="opt_b[]" id="opt-b-' + c + '" class="form-control" autocomplete="off" placeholder="Enter option...">\
					</div>\
					<div class="form-group">\
						<label for="opt-c-' + i + '">Option c</label>\
						<input type="text" name="opt_c[]" id="opt-c-' + c + '" class="form-control" placeholder="Enter option..." autocomplete="off">\
					</div>\
					<div class="form-group">\
						<label for="opt-d-' + c + '">Option d</label>\
						<input type="text" name="opt_d[]" id="opt-d-' + c + '" class="form-control" placeholder="Enter option..." autocomplete="off">\
					</div><hr/>');
			if (c == num) {
				$('.form-question').append('<div class="form-group"><div class="info"></div><button class="btn btn-success">Submit</button></div>');
			}
			c++;
		}
	});
});