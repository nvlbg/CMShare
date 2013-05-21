<?php

$load->view('includes/header.php', $header);

$load->view($main_content, $content);
$load->view('sections.php', $sections);

$load->view('includes/footer.php', $footer);