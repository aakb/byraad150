(function ($, Drupal) {
  Drupal.behaviors.pollWinners = {
    attach: function (context, settings) {
      var pollWinnerYears = $('.poll-winners-years .col');

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
        $('.poll-candidate').hide('slow');

        // Show clicked decade.
        $('.poll-candidate[data-decade="' + decade + '"]').show('slow');
      }

      // Register click listeners.
      pollWinnerYears.each(function () {
        $(this).on('click', clickDecade);
      });

      // Hide all decades.
      $('.poll-candidate').hide();

      // Find latest registered decade winner.
      var latest = null;
      $('.poll-candidate').each(function () {
        var decade = $(this).attr('data-decade');

        if (decade > latest) {
          latest = decade;
        }
      });

      // Show latest decade winner.
      if (latest !== null) {
        $('.poll-winners-years .col[data-year-show="' + latest + '"]').click();
      }
    }
  }
}(jQuery, Drupal));
