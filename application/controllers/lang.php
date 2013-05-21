<?php
class Lang extends Controller
{

    public function index()
    {
        $lang = $this->segment(2);
        
        if(file_exists(SPATH . 'application/language_packs/' . $lang . '.php'))
        {
            setcookie('language', $lang, time() + 60 * 60 * 24 * 30, '/');
        }

        $back_to = isset($_GET['back_to']) ? $_GET['back_to'] : '';

        header('Location: ' . PATH . $back_to);
        exit();
    }

}