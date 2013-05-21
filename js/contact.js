(function($) {
    var isErr = false,
        contact_error = ['Името е задължитено и не трябва да надвишава 56 символа', 'Имейла не трябва да надвишава 50 символа', 'Невалиден имейл', 'Заглавието е задължително и не трябва да надвишава 56 символа', 'Съобщението е задължително и не трябва да надвишава 500 символа'],
        succeeded_message = 'Изпратихте съобщението успешно!';

    $("#contactForm").submit(function(e) {
        e.preventDefault();

        isErr = false;

        $("#contactForm input, #contactForm textarea").css("border-color", "#C8C8C8");
        $('div.error').remove();
        var name = $.trim($("#c-name").val());
        var name_len = name.length;

        var mail = $.trim($("#c-email").val());
        var mail_len = mail.length;

        var title = $.trim($("#c-title").val());
        var title_len = title.length;

        var message = $.trim($("#c-message").val());
        var message_len = message.length;

        if(name_len == 0 || name_len > 56) {
            error("#c-name", contact_error[0]);
        }

        if(mail_len > 50) {
            error("#c-email", contact_error[1]);
        } else if(!/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i.test(mail)) {
            error("#c-email", contact_error[2]);
        }

        if(title_len == 0 || title_len > 56) {
            error("#c-title", contact_error[3]);
        }

        if(message_len == 0 || message_len > 500) {
            error("#c-message", contact_error[4]);
        }

        if(!isErr) {
            sendRequest(name, mail, title, message);
        }
    });

    function sendRequest(name, email, title, message) {
        $.ajax({
            "url": PATH + "contact/send/",
            "type": "POST",
            "data": {
                "ajax": true,
                "c-name": name,
                "c-email": email,
                "c-title": title,
                "c-message": message
            },
            "success": function(data){
                if(data != -1) {
                    $("#contactError").html('<p><img src="' + PATH + 'img/error.png" width="16" height="16" >' + data + '</p>').hide().fadeIn("slow");
                } else {
                    $("#contactForm, #contactError").slideUp();
                    $("#content").prepend('<div class="message" id="sentSucceeded"><span>' + succeeded_message + '</span></div>');
                    $("#sentSucceeded").hide().slideDown();
                }
            }
        });
    }

    function error(elm, error) {
        isErr = true;
        $('<div class="error"><p>' + error + '</p></div>').prependTo("#content").hide().fadeIn("slow");
        $(elm).css("border-color", "#E63762").vibrate("x", 10, 4, 50)
    }

})(jQuery);