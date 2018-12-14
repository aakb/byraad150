import './scss/app.scss';
import 'bootstrap/js/dist/carousel';
import '../assets/js/poll-selection';

(function ($) {
  $(function (context) {
    $(".poll-content-description").each(function() {
      $(".poll-content-expand").on('click', function() {
        $(this).prev().toggleClass("expand");
      });
    });
  });
})(jQuery);
