(function ($, Drupal) {
    Drupal.behaviors.clearForm = {
        attach: function (context, settings) {
            $('#clear-button').click(function() {
                $(this).closest('form').find("input[type=text], textarea").val("");
            });
        }
    };
})(jQuery, Drupal);