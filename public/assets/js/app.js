(function () {
	var loc = $(location).attr('href').split('/')[3];

	/* default js */
	$.ajaxSetup({
		url: 'ajax',
		dataType: 'json',
		type: 'post'
	});

	$('input, select, textarea').on({
		'mouseover': function () {
			$(this).prev('label').slideDown(500);
		},
		'keyup': () => {
			$(this).prev('label').slideDown(500);
		}
	});
	var csrf = $('#__csrf').val();
	/* ends here */

	// nav control

	$('.search, #search .close').click(function (e) {
		e.preventDefault();

		$('#search, .links').toggle();
	});

	function closeMenu() {
		$('.dp-link').css({ 'margin-left': '-50rem' });

		$('.container, footer').css({
			'margin-left': 'auto'
		});
	}

	function openMenu() {
		$('.dp-link').css({ 'margin-left': '0rem' });
		$('.container, footer').css({
			'margin-left': '12rem'
		});
	}

	if (location.pathname == '/admin') openMenu();

	$('.dp-menu').click(function () {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			closeMenu();
		} else {
			$(this).addClass('active');
			openMenu();
		}
	});

	$('.dp-link a').click(function () {
		$(this).addClass('active').siblings().removeClass('active');
	});

	// all form submittion goes here

	$('.action form').submit(function (e) {
		if (!$(this).hasClass('ignore')) {
			e.preventDefault();
			var i = $(this).children('div').children('.info');
			if ($(this).parent("div").attr('id') != 'chpwd') v.autoForm(this);
			else
				v.validateForm(this, {
					'new-password': {
						required: true,
					},
					'verify-password': {
						required: true,
						match: '#new-password'
					}
				});

			if (v.err()) i.html(v.err());
			else v.withAuto(i, { data: $(this).next('div') });
		}
	});

	$('.report form').change(function (e) {
		e.preventDefault();

		var info = $('.info');
		v.autoForm(this);
		if (v.err()) {
			info.html(v.err());
		} else {
			v.withAuto(info, { data: '.result' });
		}
	});

	// setting events

	$('.events, .custom-control-radio').click(function (e) {
		if ($(this).val()) {
			/* // for input clicks
			$(this).parent().addClass('bl').siblings().removeClass('active');
			if ($(this).parent().hasClass('active'))
				$(this).prop('checked', false);
			else
				$(this).prop('checked', true); */
		} else {
			// for div
			$(this).addClass('active').siblings().removeClass('active');
			$(this).children('input').prop('checked', true);
			// console.log($(this).children('input'))
			$(this).siblings().children('input').prop('checked', false);
		}
	});

	$('form.others').change(function () {
		v.autoForm(this);

		if (v.err()) alert(v.err());
		else v.withAuto('alert');
	});

	$('.list').click(function (e) {
		if ($(this).hasClass('bl')) $(this).removeClass('bl').find('input').prop('checked', false)
		else $(this).addClass('bl').find('input').prop('checked', true);
		
	});

	if (loc.indexOf('class') != -1) $('.students').show().siblings().hide();

	var added = false;
	$('a.details').click(function (e) {
		e.preventDefault();
		var data = $(this).attr('href').split("/");
		$.ajax({
			data: { profile: data[1], acc: data[0], __csrf: csrf },
			beforeSend: () => {
				$('.hidden').show();
				if (!added)
					$('.profile').append(`
					<div class="loader">
						<div class="ring green icofont-spin"></div>
						<div class="ring blue icofont-spin"></div>
					</div>`);
					added = true;
			},
			success: e => {
				$('.loader').remove();
				if (e.code) $('.profile').append(e.payload);
				else alert(e.msg);
			}
		});
	});

	$('.delete-event').click(function () {
		$.ajax({
			data: { type: 'delete-event', id: $(this).attr('id'), __csrf: csrf},
			dataType: 'json',
			beforeSend: () => { alert("cpnnecting") },
			success: e => {
				if (e.code) {
					alert("Event deleted!");
					v.redirect();
				} else {
					alert(e.msg);
				}
			}
		});
	});

	// closing the profile tab

	$('.profile .close').click(() => {
		$('.profile .close').next(".fetch").remove();
		$('.hidden').hide();
	});

	$('a.edit').click(function (e) {
		e.preventDefault();

		var tt = $(this).attr("href").substring(1);
		$('.action').children('.' + tt).show().siblings('div').hide();
	});

	$('.classes').change(function (e) {
		var val = $(this).val();

		if (typeof val == 'string') {
			if (val.substring(0, 3) == "Sss" || val.substring(0, 7) == "Promote")
				$(this).parent("div.form-group").next('div').css({ display: 'block' });
			else
				$(this).parent("div.form-group").next('div').css({ display: 'none' });
		} else {
			val.forEach(e => {
				if (e.substring(0, 3) == "Sss" || val.substring(0, 7) == "Promote")
					$(this).parent("div.form-group").next('div').css({ display: 'block' });
				else
					$(this).parent("div.form-group").next('div').css({ display: 'none' });
			});
		}
	});

	// setting  question

	var btn = false;
	$('#set').keyup(() => {
		$('.form-question').empty();
		var num = v.getInput('#set');
		var c = 1;
		if (num > 50) num = 50;

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
				if (!btn) {
					$('#exam-form').append('<div class="form-group"><button class="btn btn-success">Submit</button></div>'); btn = true;
				}
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

			if (v.err())
				alert(v.err());
			else
				v.withAuto('alert', { ok: "Picture changed successfully" });
		}
	});

	// fees 

	$('.progress-tab form').submit(function (e) {
		e.preventDefault();

		var i = $(this).children('.form-group').children('.info')
		v.autoForm(this);

		if (v.err()) {
			i.html(v.err());
		} else {
			v.withAuto(i);
		}
	});

	// animation {}

	var sw = $(window).innerWidth();
	if (sw < 512) {
		$('.list-item.wow').addClass('animate__bounceInUp');
	} else {
		$('.wow').removeClass('slideInLeft').removeClass('slideInRight').addClass('animate__flipInX');
	}

	// loader
	setTimeout(() => {
		$('.load').slideUp(500);
	}, 3000);


	// printing job 

	function printer(val) {
		var a = window.open('', 'print', 'height=500, width=500');
		a.document.write('<html>');
		a.document.write('<body>');
		a.document.write(val);
		a.document.write('</body></html>');
		a.document.close();
		a.focus();
		a.print();
	}


	$('.job').click(function () {
		var item = $('.print-item').html();
		var c = confirm('Do you want to continue the print operation?');

		if (c) printer(item);
	});
})(jQuery);