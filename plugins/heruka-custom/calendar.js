$ = jQuery;
$(document).ready(function() {

	$('.full-calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		timeFormat: 'H:mm',
		defaultView: 'month',
		eventSources:
		[
		  {
		    url: 'https://www.google.com/calendar/feeds/meditateinlondon.org.uk_t6mrs3mmjuf1u0ch0micbfibf8%40group.calendar.google.com/public/basic',
		    className: 'fc-pujas'
		  },
		  {
		    url: 'https://www.google.com/calendar/feeds/meditateinlondon.org.uk_03m40crkgmfqhv4b42laafiqbg%40group.calendar.google.com/public/basic',
		    className: 'fc-gp'
		  },
		  {
		    url: 'https://www.google.com/calendar/feeds/meditateinlondon.org.uk_aeu138cq8vqfdl21he3s9i1elg%40group.calendar.google.com/public/basic',
		    className: 'fc-fpttp'
		  },
		  {
		    url: 'https://www.google.com/calendar/feeds/meditateinlondon.org.uk_lumj3dg61gi77a3q174bt7imv0%40group.calendar.google.com/public/basic',
		    className: 'fc-courses'
		  }
		],
		eventClick: function(event) {
			window.open(event.url, 'gcalevent', 'width=700,height=600');
			return false;
		},
		loading: function(bool) {
			$('#loading').toggle(bool);
		}
	});
});