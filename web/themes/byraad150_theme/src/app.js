import './scss/app.scss';
import 'bootstrap/js/dist/carousel';
import '../assets/js/poll-selection';


// TODO: Check if show/hide is working
(function ($) {
  $(function (context) {
    $(".poll.poll-content-description").each(function() {
      var $minHeight = 140;
      if ( $(this).height() > $minHeight) {
        $(this).removeClass("hideDescription");
      }
    });
    $(".material__abstract.showmore").on('click', function() {
      $(this).toggleClass("hideDescription");
    });
  });
})(jQuery);
