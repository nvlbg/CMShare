(function (document) {
        var input = document.getElementById("u-avatar"),
            checkbox = document.getElementById("sqrdim"),
            formdata = false,
            boundx, boundy,
            w, h,
            x = y = 0,
            jcrop_api = false,
            error = "";

        function showUploadedItem (source) {
            var ratio = checkbox.checked ? 1 : 0,
            response = $('#response'),
            img = document.createElement('img');
            img.src = source;
            response.empty().append(img).children('img').Jcrop({
                aspectRatio: ratio,
                onSelect: updateCoords,
                onChange: showPreview,
                boxWidth: 500,
                boxHeight: 500
            }, function(){
                var bounds = this.getBounds();

                boundx = bounds[0];
                boundy = bounds[1];

                w = img.width;
                h = img.height;

                jcrop_api = this;
            });

            var preview = $('#preview'),
            img_copy = document.createElement('img');
            img_copy.src = source;
            preview.empty().append(img_copy);

            $('#sqr').css('display', 'block');
        }

        function updateCoords(coords) {
            x = coords.x;
            y = coords.y;
            w = coords.w;
            h = coords.h;
            showPreview(coords);
        }

        function showPreview(coords) {
            if (parseInt(coords.w) > 0)
            {
                var rx = 100 / coords.w;
                var ry = 100 / coords.h;

                $('#preview img').css({
                    width: Math.round(rx * boundx) + 'px',
                    height: Math.round(ry * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                    marginTop: '-' + Math.round(ry * coords.y) + 'px'
                });
            }
        }

        if (window.FormData) {
            formdata = new FormData();
        }

        input.addEventListener("change", function () {
            var reader, file;

            file = this.files[0];

            if (file.type in toObject(['image/gif', 'image/png', 'image/jpeg', 'image/pjpeg'])) {
                error = "";
                if ( window.FileReader ) {
                    reader = new FileReader();
                    reader.onloadend = function (e) {
                        showUploadedItem(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
                if (formdata) {
                    formdata.append("u-avatar", file);
                }
            } else {
                error = "The file format is not suppotred";
                alert ( error );
            }
        }, false);

        checkbox.addEventListener("change", function() {
            var ratio = checkbox.checked ? 1 : 0;
            jcrop_api.setOptions({
                aspectRatio: ratio
            });
        }, false);

        $('#avatar-upload-form').submit(function(e) {
            e.preventDefault();

            if(error !== "") {
                alert ( error );
            }
            else if (formdata) {
                var get = '?w= ' + w + '&h=' + h + '&x=' + x + '&y=' + y + '&ajaxauto=' + true;
                $.ajax({
                    url: PATH + 'settings/changeavatar/' + get,
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if(res != -1) {
                            alert(res);
                        }
                    }
                });
            }
        });

        function toObject(arr) {
            var obj = {};
            for(var i = 0, len = arr.length; i < len; i++) {
                obj[arr[i]] = null;
            }
            return obj;
        }
})(document);