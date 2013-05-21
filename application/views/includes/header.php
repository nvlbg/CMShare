<!doctype html>
<html>
<head>
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="<?php echo PATH . 'css/style.css'; ?>" />
    <link type="text/css" href="<?php echo PATH . 'css/autocomplete.css'; ?>" rel="stylesheet" />
    <meta charset="utf-8" />
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <div id="spinner"></div>
    <section id="wrapper">
        <header id="header">
            <div class="centered">
                <a href="<?php echo PATH; ?>" style="color:<?php echo LOGO_COLOR; ?>;text-shadow: <?php echo LOGO_SHADOWX; ?>px <?php echo LOGO_SHADOWY; ?>px <?php echo LOGO_BLUR; ?>px <?php echo LOGO_SHADOW; ?>" title="<?php echo SITE_NAME; ?>" id="logo"><?php echo SITE_NAME; ?></a>
                <?php Load::getInstance()->view($user_box . '.php', $login_form);?>
            </div>
        </header>
        <div id="mainmenu" class="centered">
            <nav id="nav">
                <ul>
                <?php
                $cnt = count($main_menu['links']);
                for($i = 0; $i < $cnt; $i++)
                {
                    echo '<li><a href="' . PATH . $main_menu['links'][$i] . '">' . $main_menu['names'][$i] . '</a></li>';
                }
                ?>
                </ul>
            </nav>

            <div id="searchBox">
                <form id="search" action="<?php echo PATH . 'search/'; ?>" method="GET">
                    <input type="text" id="searchField" placeholder="<?php echo $search['search']; ?>" name="for" class="inputField" />
                    <input type="submit" class="inputButton" value="<?php echo $search['submit']; ?>" />
                </form>
            </div>
        </div>
        <?php if(isset($_SESSION['is_logged']) && ($_SESSION['user_info']['permissions'] == 'a' || $_SESSION['user_info']['permissions'] == 'm')) { ?>
        <a href="<?php echo PATH . 'admin/'; ?>" id="adminButton">Administration</a>
        <?php } ?>
        <div id="changeLanguage">
            <a class="bg" href="<?php echo PATH . 'lang/bg/?back_to=' . $back_to; ?>"><img src="<?php echo PATH . 'img/flags/bg.png'; ?>" /></a>
            <a class="en" href="<?php echo PATH . 'lang/en/?back_to=' . $back_to; ?>"><img src="<?php echo PATH . 'img/flags/en.png'; ?>" /></a>
        </div>
        <div id="contentContainer" class="centered">