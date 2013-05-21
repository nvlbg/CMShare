<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <style>
        body
        {
            margin: 0;
            font-size: 16px;
            font-family: Helvetiva, Arial, sans-serif;
        }
        #content
        {
            width: 800px;
            min-height: 660px;
            margin: 40px auto;
            border: 1px solid #AAA;
        }
        #stages
        {
            float: left;
            width: 200px;
            height: 660px;
            background: #808080;
        }
        .error
        {
            background: #F2F2F2 url('../img/error.png') no-repeat;
            background-position: 6px 6px;
            border: 1px solid #A6A6A6;
            color: #F00;
            width: 540px;
            margin-left: 212px;
            padding: 4px 4px 4px 28px;
        }
        input[type=text], input[type=password]
        {
            line-height: 16px !important;
            vertical-align: top;
            height: 28px;
            width: 270px;
            outline: 0;
            padding: 0 3px;
            background: #fff;
            border: 1px solid #C8C8C8;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
        }
        input[type=text]:hover, input[type=password]:hover
        {
            border-color: #B6B6B6;
        }
        input[type=text]:focus, input[type=password]:focus
        {
            border-color: #FB1;
        }
        input[type=submit]
        {
            padding: 4px 8px;
            color: #fff;
            clear: both;
            margin-left: 185px;
            font-size: 16px;
            font-weight: bold;
            background: #666;
            border: none;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            cursor: pointer;
        }
        input[type=submit]:hover
        {
            background: #888;
        }
        #stages ol
        {
            margin: 0;
            padding: 0;
        }
        #stages li
        {
            list-style: none;
            background: #9A9A9A;
            color: #fff;
            padding: 10px 30px;
            margin-bottom: 1px;
        }
        .active
        {
            background: #07F!important;
            margin: 20px 0!important;
        }
        .form
        {
            float: left;
            padding: 20px 40px 0 40px;
            margin-bottom: 20px;
        }
        .form p label
        {
            float: left;
            width: 170px;
            padding: 6px;
        }
        .form p span
        {
            display: block;
            margin: 10px 0 20px 185px;
            width: 280px;
            color: #444;
        }
        </style>
    </head>
    <body>
        <div id="content">
            <div id="stages">
                <ol>
                <?php
                foreach($steps as $k => $v)
                {
                    $link = '<li ';
                    $link .= $k == $current ? 'class="active"' : '';
                    $link .= '>' . $v . '</li>';
                    
                    echo $link;
                }
                ?>
                </ol>
            </div>
            <div>
            <?php
            if(isset($errors))
            {
                foreach($errors as $err)
                {
                    echo '<p class="error">' . $err . '</p>';
                }
            }
            Load::getInstance()->view('install/' . $stage, $data);
            ?>
            </div>
        </div>
    </body>
</html>
