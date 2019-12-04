$(document).ready(function () {

    (function ($) {
        "use strict";


        jQuery.validator.addMethod('answercheck', function (value, element) {
            return this.optional(element) || /^\bcat\b$/.test(value);
        }, "type the correct answer -_-");

        $('#success,#error').hide();

        // validate contactForm form
        $(function () {
            $('.contactForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    phone: {
                        required: false,
                        minlength: 7
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    subject: {
                        required: true,
                    },
                    message: {
                        required: true,
                        minlength: 7
                    },
                    whereHear: {
                        required: true,
                    }
                }
            });
        });

    })(jQuery);
});