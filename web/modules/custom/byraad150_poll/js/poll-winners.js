(function ($, Drupal) {
  Drupal.behaviors.pollWinners = {
    attach: function (context, settings) {
      var pollWinnerYears = $('.poll-winners-years .poll-winners-years--decade');
      pollWinnerYears.each(function () {
        $(this).addClass('is-inactive');
      });

      /**
       * Handle decade winner clicks.
       */
      function clickDecade() {
        var decade = $(this).attr('data-year-show');

        if ($(this).hasClass('is-active')) {
          return;
        }

        // Remove is-active class from all.
        pollWinnerYears.each(function () {
          $(this).removeClass('is-active');
        });

        // Add is-active to clicked decade.
        $(this).addClass('is-active');

        // Hide all decades.
        $('.poll-candidate').addClass('is-hidden');

        // Show clicked decade.
        $('.poll-candidate[data-decade="' + decade + '"]').removeClass('is-hidden');
      }

      // Find latest registered decade winner.
      var latest = null;
      $('.poll-candidate').each(function () {
        var decade = $(this).attr('data-decade');

        if (decade > latest) {
          latest = decade;
        }

        // Add click listener and remove is-inactive class.
        $('.poll-winners-years .poll-winners-years--decade[data-year-show="' + decade + '"]').on('click', clickDecade).removeClass('is-inactive');
      });

      // Show latest decade winner.
      if (latest !== null) {
        $('.poll-winners-years .poll-winners-years--decade[data-year-show="' + latest + '"]').click();
      }
    }
  }
}(jQuery, Drupal));
