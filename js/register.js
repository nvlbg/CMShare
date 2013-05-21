(function($) {
    var error = '',
        errors = ['Потрбителското име трябва да съдържа най-малко 4 символа',
            'Потребителското име е твърде дълго',
            'Невалидно потребителско име',
            'Паролата не трябва да съвпада с потребителското име',
            'Паролата трябва да е поне 6 символа',
            'Невалидна парола',
            'Паролите не съвпадат',
            'Имейлът е твърде дълъг',
            'Невалиден имейл',
            'Имейлите не съвпадат',
            'Името е твърде дълго',
            'Невалидно име',
            'Описанието не трябва да надвишава 400 символа'
        ],
        registred_message = 'Поздравления! Вече сте регистриран/а. Може да влезете чрез формата по-горе.';
    
    for(var i = 0; i < 17; i++) {
        errors.push(i.toString());
    }

    $('<div id="registerError" class="error"></div>').prependTo('#content');

    $('#registerForm').submit(function(e) {
        e.preventDefault();
        
        $('.registerField').css('border-color', '#C8C8C8');

        if(!isValidUserName()) {
            showError('#r-username');
        } else if(!isValidPassword()) {
            showError('#r-password');
        } else if($.trim($('#r-password').val()) != $.trim($('#re-password').val())) {
            error = errors[6];
            showError('#r-password, #re-password');
        } else if(!isValidEmail()) {
            showError('#email');
        } else if($.trim($('#email').val()) != $.trim($('#re-email').val())) {
            error = errors[9];
            showError('#email, #re-email');
        } else if(!isValidName($('#first-name').val())) {
            showError('#first-name');
        } else if(!isValidName($('#last-name').val())) {
            showError('#last-name');
        } else if(!isValidDesc()) {
            showError('#description');
        } else {
            sendRequest();
        }
    });

    function isValidUserName() {
        var trimmed_user = $.trim($('#r-username').val());
        var strlen = trimmed_user.length;
        if(strlen < 4) {
            error = errors[0];
            return false;
        } else if(strlen > 32) {
            error = errors[1];
            return false;
        } else if(!/^[а-яa-z0-9_]{4,32}$/i.test(trimmed_user)) {
            error = errors[2];
            return false;
        } else {
            return true;
        }
    }

    function isValidPassword() {
        var trimmed_pass = $.trim($('#r-password').val());
        var trimmed_user = $.trim($('#r-username').val());
        var strlen_pass = trimmed_pass.length;
        if(trimmed_pass == trimmed_user) {
            error = errors[3];
            return false;
        } else if(strlen_pass < 6) {
            error = errors[4];
            return false;
        } else if(!/(?=.*[a-zа-я])(?=.*[0-9])/i.test(trimmed_pass)) {
            error = errors[5];
            return false;
        } else {
            return true;
        }
    }

    function isValidEmail() {
        var trimmed_email = $.trim($('#email').val());
        if(trimmed_email.length > 50) {
            error = errors[7];
            return false;
        } else if(!/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i.test(trimmed_email)) {
            error = errors[8];
            return false;
        } else {
            return true;
        }
    }

    function isValidName(name) {
        var trimmed_name = $.trim(name);
        var strlen = trimmed_name.length;
        if(strlen == 0) {
            return true;
        } else if(strlen > 20) {
            error = errors[10];
            return false;
        } else if(!/^[a-zа-я]{3,20}$/i.test(trimmed_name)) {
            error = errors[11];
            return false;
        } else {
            return true;
        }
    }

    function isValidDesc() {
        var trimmed_desc = $.trim($('#description').val());
        if(trimmed_desc.length > 400) {
            error = errors[12];
            return false;
        } else {
            return true;
        }

    }

    function showError(element) {
        $('#registerError').html('<p>' + error + '</p>').hide().fadeIn('slow');
        $(element).css('border-color', '#E63762').vibrate('x', 10, 4, 50);
    }

    function sendRequest() {
        var sex = document.getElementById('male').checked ? 'm' : 'f';
        $.ajax({
            'type': 'POST',
            'url': PATH + 'register/register/',
            'data': {
                'ajax': true,
                'r-username': $('#r-username').val(),
                'r-password': $('#r-password').val(),
                're-password': $('#re-password').val(),
                'email': $('#email').val(),
                're-email': $('#re-email').val(),
                'first-name': $('#first-name').val(),
                'last-name': $('#last-name').val(),
                'sex': sex,
                'description': $('#description').val()
            },
            'success': function(data){
                if(data != -1) {
                    $('#registerError').html('<p>' + data + '</p>').hide().fadeIn('slow');
                } else {
                    $('#registerForm, #registerError').slideUp();
                    $('#content').prepend('<div class="message" id="registredMessage"><span>' + registred_message + '</span></div>');
                    $('#registredMessage').hide().slideDown();
                }
            }
        });
    }
})(jQuery);