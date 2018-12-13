(function ($) {
  Drupal.behaviors.pollWinners = {
    attach: function (context, settings) {
      var pollWinnerYears = $('.poll-winners-years .col');

      function clickDecade(event) {
        var decade = $(this).attr('data-year-show');

        pollWinnerYears.each(function () {
          $(this).removeClass('is-active');
        });

        $(this).addClass('is-active');

        $('.poll-candidate').hide();
        $('.js-poll-decade-' + decade).show();
      }

      pollWinnerYears.each(function () {
        $(this).on('click', clickDecade);
      });

      $('.poll-candidate').hide();
    }
  }
}(jQuery));
