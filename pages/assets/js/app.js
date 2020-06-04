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
				$('.dp-link').show();

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
	
	$('.check2radio').change(() => {
		v.autoForm('#session');

		if (v.check()) {
			alert(v.thrower());
		} else {
			v.withAuto();
		}
	});

	$('.check2radio').click(function(e) {
		$(this).addClass('active').children('input').prop('checked', true)
		$(this).siblings('div').removeClass('active').children('input').prop('check', false);
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
});