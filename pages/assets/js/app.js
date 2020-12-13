try{
(function () {
	var loc = $(location).attr('href').split('/')[3];
	
	if (loc  != 'login' && loc == false)
		$(".owl-carousel").owlCarousel({
	    autoplay: true,
	    dots: true,
	    loop: true,
	    items: 1,
	  });
	
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

		if (!v.check()) {
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
				},error: e => {v.dError(e, true)}
			});
		}
	});

	$('.skip').click(function(e) {
		e.preventDefault();

		v.redirect('/index');
	});
	
	/* ends here */
	
	// nav control
	
	$('.search, #search .close').click(function(e) {
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

	// all form submittion goes here
	
	$('.action form').submit(function (e) {
		e.preventDefault();
		var i = $(this).children('div').children('.info');

		if ($(this).parent("div").attr('id') != 'chpwd') {
			v.autoForm(this);

			if (!v.check()) {
				i.html(v.thrower());
			} else {
				if (!$(this).hasClass('ignore'))
					v.withAuto(i, {data: $(this).next('div')});
				else
					e.currentTarget.submit();
			}
		}
	});

	$('.report form').change(function(e) {
		e.preventDefault();

		var info = $('.info');
		v.autoForm(this);
		if (!v.check()) {
			info.html(v.thrower());
		} else {
			v.withAuto(info, {data: '.result'});
		}
	});

	// setting events
	
	$('.check2radio').click(function(e) {
		if ($(this).hasClass('active')) {
			$(this).children().removeClass('active').prop('checked', false);
		} else {
			$(this).addClass('active').children('input').prop('checked', true);
			$(this).siblings('div').removeClass('active').children('input').prop('checked', false);
		}
		
		// setting event 
			
			var p = $(this).parent('form');
			var i = $(p).children('div').children('.info');
			v.autoForm(p);
	
			if (!v.check()) {
				alert(v.thrower());
			} else {
				v.withAuto(i);
			}
	});

	$('.list').click(function(e) {
		if ($(this).hasClass('bl')) {
			$(this).removeClass('bl').children('input').prop('checked', false)
		} else {
			$(this).addClass('bl').children('div').children('input').prop('checked', true);
		}
	});
	
	if (loc.indexOf('class') != -1) {
		$('.students').show().siblings().hide();
	}

	$('a.details').click(function (e) {
		e.preventDefault();
		var data = $(this).attr('href').split("/");
		$.ajax({
			data : {profile: data[1], acc: data[0]},
			beforeSend: () => {
				$('.hidden').css({display: 'grid'});
			}, 
			success: e => {
				if (e.msg == "ok") {
					$('.profile').append(e.payload);
				} else {
					alert(e.msg);
				}
			}
		});
	});

	$('.delete-event').click(function () {
		$.ajax({
			data : {type: 'delete-event', id: $(this).attr('id')},
			success: e => {
				if (e.msg == "ok") {
					alert("Event deleted!");
					v.redirect();
				} else {
					alert(e.msg);
				}
			}
		});
	})

	// closing the profile tab

	$('.profile .close').click(() => {
		$('.profile .close').next("div.header").remove();
		$('.hidden').hide();
	});

	$('a.edit').click(function(e) {
		e.preventDefault();

		var tt = $(this).attr("href").substring(1);
		$('.action').children('.' + tt).show().siblings('div').hide();
	});

	$('.classes').change(function(e) {
		var val = $(this).val();

		if (typeof val == 'string') {
			if (val.substring(0, 3) == "Sss" || val.substring(0, 7) == "Promote")
				$(this).parent("div.form-group").next('div').css({display: 'block'});
			else 
				$(this).parent("div.form-group").next('div').css({display: 'none'});
		} else {
			val.forEach(e => {
				if (e.substring(0, 3) == "Sss" || val.substring(0, 7) == "Promote")
					$(this).parent("div.form-group").next('div').css({display: 'block'});
				else 
					$(this).parent("div.form-group").next('div').css({display: 'none'});
			});
		}
	});
	
	// setting  question
	
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

	$("form#change-pic").change(function (e) {
		e.preventDefault();
		var chk = confirm(
			"You're about to update this image, do you want to continue!"
		);

		if (chk) {
			v.autoForm(this);

			if (!v.check())
				alert(v.thrower());
			else
				v.withAuto('alert', {ok: "Picture changed successfully"});
		}
	});
	
	$('.contact .item, .contact .h3').on({
		'mouseover': function() {
			$(this).prev('.h3').children('i').addClass('radi');
		},
		'mouseleave': function () {
			$(this).prev('.h3').children('i').removeClass('radi');
		}
	});
	
	// fees 
	
	$('.progress-tab form').submit(function(e) {
		e.preventDefault();
		
		var i = $(this).children('.form-group').children('.info')
		v.autoForm(this);
		
		if (!v.check()) {
			i.html(v.thrower());
		} else {
			v.withAuto(i);
		}
	});
	
	// animation {}
	
	 var sw = $(window).innerWidth();
		if  (sw < 512) {
			$('.list-item.wow').addClass('animate__bounceInUp');
	} else {
		$('.wow').removeClass('slideInLeft').removeClass('slideInRight').addClass('animate__flipInX');
	}
	
	// loader
	setTimeout(() => {
		$('.load').slideUp(500);
	}, 3000);
})(jQuery);}catch(a){alert(a)}