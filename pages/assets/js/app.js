$(document).ready(function () {
	/* default js */
	$('input').on({
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
		console.log($("#" + id).siblings())
	});

	$(".auth form").submit(function (e) {
		e.preventDefault();
		
		var rule = [
			{
				require: true,
				email: true,
				min: 10,
				error: "Email is required!"
			},
			{
				require: true,
				min: 8,
			},
			{
				require: true,
				error: "Enter the captcha code"
			}, {}, {}
		]

		var info = $('.info');
		
		v.form(this, rule);

		if (!v.check()) {
			info.html(v.thrower()).css({'color': '#b28200', 'font-style': 'oblique'});
		} else {
			$.ajaxSetup({
				url: 'ajax',
				type: 'post',
			});
			
			$.ajax({
				data: $(this).serialize(),
				beforeSend: () => {
					info.html("Connecting to the server...");
				},
				success: e => {
					info.empty();
					if (e == 'ok') {
						info.html('You are logged!').css({"color": "#36a509"});
						$(this).children('#captcha').empty();
						v.redirect();
					} else {
						var se = e.split(" ");

						if (se.length == 2) {
							if (se[0] == "ok") {
								info.html('You are logged!').css({"color": "#36a509"});
								$(this).children('#captcha').empty();
								v.redirect(se[1]);
							} else if (se[0] == 'change') {
								$('.auth .info').empty();
								$(".auth-content #chpwd").show().siblings().hide();
								$('#chpwd .days').html("Its been <b>" + se[1] + "days</b> since you last change your password!");
							} else if (se[0] == 'cap') {
								$(this).children('#captcha').html(v.captcha(se[1]));
							}
						} else {
							$(this).children('#captcha').empty();
							info.html(e).css({'color': '#d80808', 'font-style': 'oblique'});
						}
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
			alert()
		});
		$('.dp-menu').click(() => {

			if ($('.dp-menu').hasClass('active')) {
				$('.dp-link').css({
					'margin-left': '-50rem'
				})
				$('.dp-menu').removeClass('active');
				$('.container').css({
					'margin-left': 0
				});
			} else {
				$('.dp-link').css({
					'margin-left': 0
				})
				$('.dp-menu').addClass('active')
				$('.container').css({
					'margin-left': '11rem'
				});
			}
		});
		
		$('.action form').submit(function (e) {
			e.preventDefault();
			
			v.dError(this, true);
		});
});