/* eslint-env jquery */
(function ($) {
  Drupal.behaviors.pollSelection = {
    attach: function (context, settings) {
      $(document).ready(function () {
        function setResults() {
          // Remove previous poll-results.
          $('.js-poll-result').remove();

          var choiceResults = $('.js-choice-result');
          var usersChoiceId = $('.choice-title[data-user-selected="1"]').text();

          if (choiceResults.length > 0) {
            $('.js-poll-content-choose').addClass('is-hidden');
          }
          else {
            $('.js-poll-content-choose').removeClass('is-hidden');
          }

          choiceResults.each(function () {
            var choiceElement = $(this);

            var parentContainer = $(this).parents('.container-fluid').first();

            var choiceId = choiceElement.attr('data-choice');
            var result = choiceElement.attr('data-result');
            var resultPercentage = result + '%';

            var jsPollSelect =  parentContainer.find('.js-poll-select[data-entity-id="' + choiceId + '"]');

            var usersChoice = '';

            if (choiceId === usersChoiceId) {
              usersChoice = '<div class="poll-users-choice">' + Drupal.t("Your choice") + '</div>';
            }

            var element = $(
              '<div class="poll-result js-poll-result">' + usersChoice + '<div class="progress">' +
              '  <div class="progress-bar" role="progressbar" style="width: ' + resultPercentage + '" aria-valuenow="' + result + '" aria-valuemin="0" aria-valuemax="100">' + resultPercentage + '</div>' +
              '</div></div>'
            );

            jsPollSelect.find('.poll-content').append(element);
          });
        }

        // Act on poll selection.
        $('.js-poll-select').click(function () {
          if ($(this).hasClass('is-locked')) {
            // Action to take if poll is locked.
          }
          else {
            // Remove all instances of is-active.
            $('.js-poll-select').removeClass('is-active');

            // Add is-active to selected element.
            $(this).addClass('is-active');
            // Get radio button id through matching label/Brick title.
            var entity_id = $(this).data('entity-id');
            var radioId = $('.js-poll .option').filter(function () {
              return (parseInt($(this).text()) === entity_id)
            }).attr('for');

            // Set checked on radio button match.
            $('#' + radioId).prop('checked', true);
          }
        });

        // Check state of poll for the user (If we show meter template a "total" class exists)
        // This way we know that the user cast their vote already.
        if($( ".total" ).length > 0) {
          // Lock the poll if vote was cast.
          $('.js-poll-select').addClass('is-locked');

          // Get selected choice
          var selected = $('.choice-title[data-user-selected="1"]').once('pollSelection').text();

          // Set previously selected choice.
          $('.poll-teaser-item[data-entity-id="' + selected + '"]').addClass('is-active');
        }
        else {
          // Remove locked state and is-active state on all poll elements.
          $('.js-poll-select').removeClass('is-locked').removeClass('is-active');
        }

        setResults();
      });
    }
  }
})(jQuery);
