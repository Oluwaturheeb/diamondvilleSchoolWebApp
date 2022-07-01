(function ($) {
  "use strict";

  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($('#spinner').length > 0) {
        $('#spinner').removeClass('show');
      }
    },
      1);
  };
  spinner();


  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
  });
  $('.back-to-top').click(function () {
    $('html, body').animate({
      scrollTop: 0
    }, 1500, 'easeInOutExpo');
    return false;
  });


  // Sidebar Toggler
  $('.sidebar-toggler').click(function () {
    $('.sidebar, .content').toggleClass("open");
    return false;
  });


  // Progress Bar
  $('.pg-bar').waypoint(function () {
    $('.progress .progress-bar').each(function () {
      $(this).css("width", $(this).attr("aria-valuenow") + '%');
    });
  },
    {
      offset: '80%'
    });

  // Calender
  $('#calender').datetimepicker({
    inline: true,
    format: 'L'
  });

  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1000,
    items: 1,
    dots: true,
    loop: true,
    nav: false
  });

  // printing job
  function printer(val, title) {
    var a = window.open('print',
      'print',
      'height=960, width=768');
    a.document.write(`
      <!DOCTYPE html>
      <html>
      <head>
      </head>
      <body width="1024">
      ${val}
      <style>
      body {
        text-align: center;
      }
      
      h1 {
        color: #49a835;
        margin-bottom: 0;
      }
      header .d-flex * {
        display: inline-block;
      }
      
      header div:last-of-type *{
        display: inline-block !important;
        margin-bottom: 2rem;
      }
      
      header div:last-of-type img {
       width: 5rem;
        height: 5rem;
        vertical-align: top;
        border-radius: 5px;
        margin-right: .5rem;
        border: 1px solid #49a835;
        padding: 5px;
      }
      
      table {
        align: center;
        width: 50%;
        margin: auto;
      }
      
      @media (max-width: 576px) {
        table {
          width: 100% !important;
        }
      }
      
      table * {
        border: 1px solid;
        text-align: center;
      }
    </style>

      </body>
      </html>
      `);
    a.document.title = title;
    a.document.close();
		a.focus();
		a.print();
  }


  $('.fa-print').click(function () {
    var item = $(this).parent().next('.to-print').html();
    var title = $(this).parent().next('.to-print').find('header div h3').html();
    title += ' - ' + $(this).parent().next('.to-print').find('.toprintresult').html();
    
    var c = confirm('Do you want to continue the print operation?');
    if (c) printer(item, title);
  });

  $('#imageFile').change(function () {
    var form = new FormData();
    form.append('type', $(this).attr('data-type'));
    form.append('imageFile', $(this).get(0).files[0]);
    form.append('__csrf', $('input[name=__csrf]').val());
    $.ajax({
      url: '/uploader',
      data: form,
      type: 'post',
      processData: false,
      cache: false,
      contentType: false,
      success: e => {
        if (e.code) {
          $('.img').remove('.fa-user, img').html(`<img src="${e.img}">`);
        }
      },
      error: e => alert(JSON.stringify(e)),
    });
  });

	$('select[name=class]').change(function () {
		if ($(this).val() == 'Sss 1') $('div.dept').show();
		else if ($(this).val() == 'Sss 2') $('div.dept').show();
		else if ($(this).val() == 'Sss 3') $('div.dept').show();
		else $('div.dept').hide().children('select#dept').children('option:first').attr('selected', true);
	});

	$('input#check-all').change(function() {
		if ($(this).prop('checked') == true) $(this).parents('form').find('input[type=checkbox]').prop('checked', true);
		else $(this).parents('form').find('input[type=checkbox]').prop('checked', false);
	})
})(jQuery);
