var $ = jQuery;

$(function(){

  $(document).ready(function() {

    /*Accordion for weekly classes sidebar */
    $('.widget_weekly_classes .accordion h5').click(function() {
        $(this).next().toggle();
        $(this).toggleClass("active");
        return false;
    }).next();

    $(".show-classes a").click(function() {
      $(".show-classes a").removeClass("selected");
      $(this).addClass("selected");
      $(".class-weekday").toggle( $(this).hasClass("show-weekday") );
      $(".class-location").toggle( $(this).hasClass("show-location") );
      $( '.pgmm' ).pronamicGoogleMapsMashup();
    });

    $(".responsive-tabs__list__item:contains('Map')").click(function() {
      $( '.pgmm' ).pronamicGoogleMapsMashup();
    });

    if ($(window).width() > 600) {
      $("#mega-menu-primary > li > a").click(function() {
        $("#navbar").css("position", "absolute");
        $(window).scrollTop(0); //TODO
        if ($(".arrow-up", $(this).parent()).length == 0) {
          $(this).after("<div class='arrow-up'></div>");
        }
      });
    }
    
    $("blockquote").each(function(i, el) {
      if ($("p", el).length < 2) {
        return;
      }
      $("p", el).hide();
      $("p:first, p:last", el).show();
      $("p:last",el).before("<p><a href='#' class='more-info'>Read more</a></p>");
      $(".more-info", el).click(function() {
        $("p",el).show();
        $(this).remove();
        return false;
      });
    });

    if ($(window).width() < 600) {
      /*$("#mega-menu-primary-2 > li > ul").each(function() {
        $("li:not(.mega-menu-item-weekly_classes-6):first", this).addClass("selected");
        $("li#mega-menu-item-weekly_classes-6 section:first", this).addClass("selected");
      });*/
      var menuHeaders = $("> li > ul > li.mega-menu-item-has-children > a, h5, .mega-block-title", "#mega-menu-primary");
      menuHeaders.click(function() {
        if ($(this).closest("li,section").hasClass("selected")) {
          return true;
        }
        menuHeaders.closest("li,section").removeClass("selected");
        $(this).closest("li,section").addClass("selected");
        return false;
      });
    }

    /*if (!$.cookie("survey")) {
      $("body").append('<div class="survey">Tell us what you think about our new website<i class="fa fa-times"></i></div>');
      $(".survey .fa-times").click(function() {
        $(".survey").hide();
        if (confirm("We're about to hide this feedback link permanently.  Is this okay?")) {
          $.cookie("survey", true);
        }
        return false;
      });
      $(".survey").delay( 1000 ).slideDown("slow");

      $(".survey").click(function() {
        window.open("https://docs.google.com/forms/d/1OEGOpBfT4NpxR-uJG8FGi8-y-wyGtRmRis885c5bp2M/viewform?entry.1675712976&entry.1444863315&entry.493367833&entry.618898896&entry.1118957379="+navigator.userAgent + "---"+JSON.stringify($.browser)+"---"+screen.width+"x"+screen.height);
      });
    }*/


    if (window.location.search.toLowerCase().indexOf("booknow=true") == -1) {
      $(".single-event .bookings.widget").addClass("minimised");  
    }
    $(".single-event .start-booking").click(function() {
      $(".single-event .bookings.widget").removeClass("minimised");
    });

  });

  $(document).bind('em_booking_complete', function() {
    var form = $('.em-booking-form:last').serializeObject();

    if(!form.hasOwnProperty('amount')) {
      return;
    }

    var data = {
      'cmd': '_donations',
      'business': 'Y2FU9N7UEXKM4',
      'lc': 'GB',
      'item_name': 'Heruka KMC Event Donation - '+$(".bookings:first h3 strong").text(),
      //no_note=1&cn=Add%20special%20instructions%20to%20the%20seller%3a&
      //no_shipping=2&
      //rm=1
      'return': 'http://www.meditateinlondon.org.uk/courses-retreats/payment-received',
      'cancel_return': window.location.href,
      'currency_code': 'GBP',
      //'bn'=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
      'notify_url': 'http://www.meditateinlondon.org.uk/wp-admin/admin-ajax.php?action=em_payment&em_payment_gateway=paypal',
      'amount': form['amount'],
      'first_name': form['first_name'],
      'last_name': form['last_name'],
      'address1': form['dbem_address'],
      'zip': form['dbem_zip'],
      'city': form['dbem_city'],
      'email': form['user_email'],
      'H_PhoneNumber': form['dbem_phone']
    }

    var url = 'https://www.paypal.com/cgi-bin/webscr?'+decodeURIComponent($.param(data));
    
    if (parseFloat(form['amount']) == 0 || form['amount'] == '') {
      $(".em-booking-message-success").html(
        "<p><strong>Your booking is successful!</strong></p><p>You'll get an email very soon with all the details.</p><p><a href='"+url+"' class='button'>Make a donation</a></p>"
      );
    }
    else
    {
      $(".em-booking-message-success").html(
        "<p><strong>Your booking is successful!</strong></p><p>You'll get an email very soon with all the details.</p><p>Please wait while you are being redirected to PayPal to make your donation.</p><p><a href='"+url+"'>Please click here</a> if it's taking longer than 5 seconds.</p>"
      );
      window.location.href = url;

    }
  });
});

$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};