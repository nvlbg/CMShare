(function() {
    var textarea = $('#comment').hide();

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
        '<div contentEditable="true" class="wysiwyg" id="output">' + textarea.val() + '</div>').insertBefore(textarea);

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

    $('#commentForm').submit(function() {
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
    });
})();