<!doctype html>
<html>
<head>
    <title><?php echo $page_title; ?></title>
    <meta charset="utf-8" />
    <style>
    body
    {
        margin: 0;
        padding: 0;
        background: #F5F5F5;
    }
    #verifyForm
    {
        width: 300px;
        margin: 100px auto;
        border: 5px solid #888;
        padding: 10px;
        background: #F1F1F1;
        
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }
    #verifyForm form p
    {
        margin-bottom: 30px;
    }
    #verifyForm form p input[type="text"], #verifyForm form p input[type="password"]
    {
        border: 1px solid #C8C8C8;
        height: 28px;
        line-height: 24px!important;
        padding: 0 3px;
        outline: 0;
        vertical-align: top;
        width: 290px;

        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
    }
    #verifyForm form p input[type="text"]:hover, #verifyForm form p input[type="password"]:hover
    {
        border-color: #B6B6B6;
    }
    #verifyForm form p input[type="text"]:focus, #verifyForm form p input[type="password"]:focus
    {
        border-color: #FB1;
    }
    #verifyForm form input[type="submit"]
    {
        background: #666;
        color: #FFF;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        padding: 8px;
        border: none;
        display: block;
        margin: 0 auto;

        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
    }
    #verifyForm form input[type="submit"]:hover
    {
        background: #888;
    }
    #verifyForm form p label
    {
        color: #333;
        text-shadow: 1px 1px 0 #999;
        font-weight: bold;
        font-size: 20px;
        line-height: 30px;
        margin: 6px 4px;
        display: block;
    }

    p.error
    {
        color: #D11;
        font-size: 18px;
        border: 1px solid #AAA;
        padding: 2px;
        text-shadow: 1px 1px 0 #BBB;
        background: #D9D9D9;
    }
    </style>
</head>
<body>
    <div id="verifyForm">
        <?php
        if(isset($errors))
        {
            foreach($errors as $err)
            {
                echo '<p class="error">' . $err . '</p>';
            }
        }
        ?>
        <form action="" method="POST">
            <p>
                <label for="admin_name"><?php echo $labels['admin_name']; ?></label>
                <input type="text" name="admin_name" value="<?php if(isset($inputs['admin_name'])) { echo $inputs['admin_name']; } ?>" />
            </p>
            <p>
                <label for="admin_password"><?php echo $labels['admin_password']; ?></label>
                <input type="password" name="admin_password" />
            </p>
            <input type="submit" value="<?php echo $submit; ?>" />
        </form>
    </div>
</body>
</html>