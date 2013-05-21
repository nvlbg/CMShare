<!doctype html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo PATH . 'css/admin.css'; ?>" />
    <link type="text/css" href="<?php echo PATH . 'css/jquery-ui-1.8.17.custom.css'; ?>" rel="stylesheet" />
    <meta charset="utf-8" />
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <div id="main">
            <nav id="main-menu">
                <ul>
                    <li>
                        <a href="#"><?php echo $labels['article']; ?></a>
                        <ul>
                            <li><a href="<?php echo PATH . 'admin/article/write/'; ?>"><img src="<?php echo PATH . 'img/author_icon.png'; ?>" width="16" height="16" /><?php echo $labels['article_w']; ?></a></li>
                            <li><a href="<?php echo PATH . 'admin/article/edit/'; ?>"><img src="<?php echo PATH . 'img/edit_icon.png'; ?>" width="16" height="16" /><?php echo $labels['article_e']; ?></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo PATH . 'admin/add_category/'; ?>"><?php echo $labels['category'];  ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $labels['users']; ?></a>
                        <ul>
                            <li><a href="<?php echo PATH . 'admin/users/add/'; ?>"><img src="<?php echo PATH . 'img/add_icon.png'; ?>" width="16" height="16" /><?php echo $labels['users_a']; ?></a></li>
                            <li><a href="<?php echo PATH . 'admin/users/edit/'; ?>"><img src="<?php echo PATH . 'img/edit_icon.png'; ?>" width="16" height="16" /><?php echo $labels['users_e']; ?></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><?php echo $labels['settings']; ?></a>

                        <ul>
                            <li><a href="<?php echo PATH . 'admin/appearance/'; ?>"><img src="<?php echo PATH . 'img/appearance_icon.png'; ?>" width="16" height="16" /><?php echo $labels['appear']; ?></a></li>
                            <li><a href="<?php echo PATH . 'admin/settings/'; ?>"><img src="<?php echo PATH . 'img/settings_icon.png'; ?>" width="16" height="16" /><?php echo $labels['settings']; ?></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div id="messages">
                <a href="<?php echo PATH . 'admin/feedback/'; ?>" class="messages"></a>
            </div>
        </div>