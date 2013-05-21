(function() {
    var language = $.cookie('language') || 'bg';

    $('#article_textarea').ckeditor({
        language : language,
        smiley_descriptions : [
            ':)', ':(', ';)', ':D', ':/', ':P', ':*)', ':-o',
            ':|', '>:(', 'o:)', '8-)', '>:-)', ';(', '', '', '',
            '', '', ':-*', ''
        ]
    });
})();