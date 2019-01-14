import './scss/app.scss';
import 'popper.js/dist/umd/popper';
import 'bootstrap/js/dist/carousel';
import 'bootstrap/js/dist/collapse';
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


