(function() {
    var textarea = $('#cm-comment').hide();

    $('<div id="commentFormattings">' +
    '<a href="#" class="wysiwyg-item wysiwyg-bold" id="bold" alt="Bold"></a>' +
    '<a href="#" class="wysiwyg-item wysiwyg-italic" id="italic" alt="Italic"></a>' +
    '<a href="#" class="wysiwyg-item wysiwyg-underline" id="underline" alt="Underline"></a>' +
    '<a href="#" class="wysiwyg-item wysiwyg-remove-format" id="removeFormat" alt="Remove format"></a>' +
    '<a href="#" class="wysiwyg-item wysiwyg-undo" id="undo" alt="Undo"></a>' +
    '<a href="#" class="wysiwyg-item wysiwyg-redo" id="redo" alt="Redo"></a>' +
    '<a href="#" class="wysiwyg-item wysiwyg-create-link" id="createLink" alt="Create link"></a>' +
    '<a href="#" class="wysiwyg-item wysiwyg-remove-link" id="unlink" alt="Remove link"></a>' +
    '</div>' +
    '<div contentEditable="true" class="wysiwyg" id="output"></div>').insertBefore(textarea);

    //var output = document.getElementById('output');
    //var outputDoc = output.document || output.contentDocument;
    //outputDoc.designMode = 'on';

    document.execCommand('styleWithCSS', false, false);

    $('#output a').click(function(e) {
            e.stopImmediatePropagation();
    });

    $('#createLink').click(function(e) {
        var link = prompt('Link', '');
        if(link !== null && /(http|https):\/\/[^<>()\s]+?/.test(link)) {
                document.execCommand(this.id, false, link);
        }

        e.preventDefault();
        e.stopImmediatePropagation();
    });

    $('#commentFormattings a').click(function() {
        document.execCommand(this.id, false, null);
    });

    var errors = [
        'Моля, напишете коментар.',
        'Коментарът е твърде дълъг. Максимумът е 400 знака.',
        'Невалидно име.',
        'Невалиден имейл.'
    ];
    
    $('#commentForm').submit(function(e) {
        e.preventDefault();

        if($('p.comment-error').length == 0) {
            $('<p id="comment-error" class="comment-error"></p>').insertAfter('#comments');
        }

        var val = $('#output').html();
        
        // Bold
        val = val.replace(/\<b\>/gi, '[b]');
        val = val.replace(/\<\/b\>/gi, '[/b]');

        // Italic
        val = val.replace(/\<i\>/gi, '[i]');
        val = val.replace(/\<\/i\>/gi, '[/i]');

        // Underline
        val = val.replace(/\<u\>/gi, '[u]');
        val = val.replace(/\<\/u\>/gi, '[/u]');

        // Links
        val = val.replace(/\<a href="(.*)"\>(.*)\<\/a\>/gi, '[url=$1]$2[/url]');

        // Replacing html <br>s with new lines
        val = val.replace(/\<br\>/gi, '\n');

        textarea.val(val);

        var name = $('#cm-name').length == 1 ? $('#cm-name').val() : null,
            email = $('#cm-email').length == 1 ? $('#cm-email').val() : null,
            comment = textarea.val(),
            commentError = $('#comment-error');

        if(comment.length == 0) {
            commentError.text(errors[0]).hide().fadeIn('slow');
            return;
        } else if (comment.length > 400) {
            commentError.text(errors[1]).hide().fadeIn('slow');
            return;
        }

        if(name !== null && !/^[a-zа-я]{3,20}$/i.test($.trim(name))) {
            commentError.text(errors[2]).hide().fadeIn('slow');
            return;
        }

        if(email !== null && !/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i.test($.trim(email))) {
            commentError.text(errors[3]).hide().fadeIn('slow');
            return;
        }

        $.ajax({
            'type' : 'POST',
            'url' : PATH + 'article/comment/',
            'data' : {
                'ajax' : true,
                'check' : 1,
                'cm-comment' : comment,
                'cm-name' : name,
                'cm-email' : email
            },
            'success' : function(data) {
                if(data != -1) {
                    commentError.text(data).hide().fadeIn('slow');
                } else {
                    commentError.hide();
                    var comment = $('#output').html(),
                        avatar, username,
                        d = new Date(),
                        monthNames = ["January", "February", "March",  "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        date = monthNames[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear() + " at " + d.getHours() + ":" + d.getMinutes();

                    if(typeof USER_INFO !== 'undefined') {
                        avatar = USER_INFO.avatar_path;
                        username = '<a class="c-username" href="' + PATH + 'user/' + USER_INFO.user_id + '/">' + USER_INFO.username + '</a>';
                    } else {
                        avatar = PATH + 'img/avatars/44_no_avatar.jpg';
                        username = '<span class="c-name">' + name + '</span>';
                    }

                    $('#output').empty();
                    $('<div class="comment"><img height="44" width="44" src="' + avatar + '">' + username + '<span class="c-written">' + date + '</span><p>' + comment + '</p></div>').appendTo('#comments').hide().slideDown('slow');
                }
            }
        });
    });

})();