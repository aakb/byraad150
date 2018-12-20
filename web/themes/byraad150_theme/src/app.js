import './scss/app.scss';
import 'bootstrap/js/dist/carousel';
import '../assets/js/poll-selection';

(function ($) {
  $(function (context) {
    $(".poll-content").each(function() {
      $(".poll-content-expand").on('click', function() {
        $(this).parent().toggleClass("expand");
      });
    });
  });
  $(document).scroll(function() {
    if($(window).scrollTop() === 0) {
      $("body").addClass('scrolltop');
    } else {
      $("body").removeClass('scrolltop');
    }
  });
})(jQuery);


