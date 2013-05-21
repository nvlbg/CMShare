(function() {
    var tc = $('#textColor'),
        sc = $('#shadowColor'),
        sx = $('#shadowX'),
        sy = $('#shadowY'),
        blur = $('#blur'),
        sample = $('#sample'),

        tcb = $('#textColorBox').farbtastic(function() {
            tc.val(this.color);
            sample.css('color', this.color);
        }),
        scb = $('#shadowColorBox').farbtastic(function() {
            sc.val(this.color);
            shadowUpdate();
        });

    var shadowUpdate = function() {
        sample.css('textShadow', sx.val() + 'px ' + sy.val() + 'px ' + blur.val() + 'px' + sc.val());
    };

    $('#title').keyup(function() {
        sample.text($(this).val());
    });

    tc.focus(function() {
        tcb.stop(true, true).fadeIn(500);
    });

    tc.blur(function() {
        tcb.stop(true, true).fadeOut(500);
    });

    tc.change(function() {
        sample.css('color', $(this).val());
    });

    sc.focus(function() {
        scb.stop(true, true).fadeIn(500);
    });

    sc.blur(function() {
        scb.stop(true, true).fadeOut(500);
    });

    sc.change(shadowUpdate);
    sx.change(shadowUpdate);
    sy.change(shadowUpdate);
    blur.change(shadowUpdate);

    sample.css({
        color : tc.val(),
        textShadow : sx.val() + 'px ' + sy.val() + 'px ' + blur.val() + 'px' + sc.val()
    });

    var elem = document.createElement('input');
    elem.setAttribute('type', 'range');

    if(elem.type === 'text') {
        sx.hide();
        $('<div></div>').slider({
            animate : true,
            max : 50,
            min : -50,
            value : sx.val(),
            step : 1,
            slide : function(e, ui) {
                sx.val(ui.value);
                shadowUpdate();
            }
        }).css('width', '200px').insertBefore(sx);

        sy.hide();
        $('<div></div>').slider({
            animate : true,
            max : 50,
            min : -50,
            value : sy.val(),
            step : 1,
            slide : function(e, ui) {
                sy.val(ui.value);
                shadowUpdate();
            }
        }).css('width', '200px').insertBefore(sy);

        blur.hide();
        $('<div></div>').slider({
            animate : true,
            max : 100,
            min : 0,
            value : blur.val(),
            step : 1,
            slide : function(e, ui) {
                blur.val(ui.value);
                shadowUpdate();
            }
        }).css('width', '200px').insertBefore(blur);
    }
})();