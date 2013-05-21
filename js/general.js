(function(window, document) {
    var opts, target, spinner,
        sidebarPages = ["article", "category", "contact", "forgotten", "home", "register", "search", "settings", "tag", ""],
        scriptPages = ["article", "contact", "register", "settings"];

    var supports = (function() {
        var div = document.createElement('div');
        var vendors = new Array();
        vendors[0] = 'Khtml';
        vendors[1] = 'Ms';
        vendors[2] = 'O';
        vendors[3] = 'Webkit';
        vendors[4] = 'Moz';
        len = vendors.length;

        return function(prop) {
            if ( prop in div.style )
            {
                return true;
            }

            prop = prop.replace(/^[a-z]/, function(val){return val.toUpperCase();});

            while(len--) {
                if ( vendors[len] + prop in div.style ) {
                    return true;
                }
            }
            return false;
        };
    })();

    var getControllerName = function(fullLink) {
        if(fullLink[fullLink.length - 1] != '/') {
            fullLink += '/';
        }
        
        return fullLink.substring(PATH.length, fullLink.indexOf('/', PATH.length)).toLowerCase();
    };

    var in_array = function(val, arr) {
        for(var i = 0, len = arr.length; i < len; i++) {
            if(arr[i] == val) {
                return true;
            }
        }

        return false;
    };

    var addScript = function(script) {
        if(script.indexOf(PATH) != 0)
            return;

        var name = getControllerName(script);

        if(in_array(name, scriptPages)) {
            $.ajax({
                dataType: 'script',
                cache: true,
                url: PATH + 'js/' + name + '.js'
            });
        }
    };

    var updatePage = function(url, method) {

        method = method || 'POST';
        opts = opts || {
                lines: 12,
                length: 8,
                width: 4,
                radius: 12,
                color: '#fff',
                speed: 1.5,
                trail: 40,
                shadow: true
            };
        target = target || $('#spinner');
        spinner = spinner || new Spinner(opts);

        $.ajax({
            'url': url,
            'type': method,
            'beforeSend': function() {
                spinner.spin();
                target.append(spinner.el);
                $('#spinner').css({opacity: 0.9, display: 'inline-block'});
            },
            'data': {
                'ajaxauto': true
            },
            'success': function(data) {
                var controller = getControllerName(url);

                if(controller == PATH.toLowerCase()) {
                    controller = "";
                }
                
                if(!in_array(controller, sidebarPages)) {
                    $('#sideBars').hide();
                } else {
                    $('#sideBars').show();
                }

                $('#content').hide().replaceWith(data).fadeIn('slow');


                addScript(url);
                spinner.stop();
                target.hide();
            }
        });
    };

    if (window.History.enabled) {

        var type, body = $('body');

        function stopPropagation(e) {
            e.stopPropagation();
        }

        $('a#adminButton').click(stopPropagation);
        $('a#logout').click(stopPropagation);
        $('#changeLanguage').find('a').click(stopPropagation);

        body.delegate('a', 'click', function(e) {
            if( this.href !== History.getState().url ) {
                History.pushState(null, null, this.href);
            }
            e.preventDefault();
        });


        /*

            body.delegate('form', 'submit', function(e) {
                type = this.method;
                History.pushState(null, null, this.action);
                e.preventDefault();
            });

        */

        History.Adapter.bind(window, 'statechange', function() {
            var url = History.getState().url;
            if(url.substr(0, PATH.length) === PATH) {
                $('#changeLanguage').find('a').each(function() {
                    var $this = $(this);
                    $this.attr('href', PATH + 'lang/' + $this.attr('class') + '/?back_to=' + url.substr(PATH.length));
                });
            }
            updatePage(url, type);
        });
    }

    if(!supports('transition')) {
        $('#nav').children('ul').children('li').children('a').hover(function() {
            $(this).stop().animate({paddingTop: 16}, 100);
        }, function(){
            $(this).stop().animate({paddingTop: 10}, 100);
        });
    }

    $('#searchField').attr('autocomplete', 'off').autocomplete({
        source: function(req, add){
            $.ajax({
                url: PATH + 'search/',
                type: 'GET',
                dataType: 'json',
                data: {
                    'for': req.term,
                    ajaxautocomplete: true
                },
                success: function(data) {
                    add(data);
                }
            });
        },
        autoFocus: true
    });
    
})(this, document);