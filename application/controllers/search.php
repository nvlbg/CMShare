<?php
class Search extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Search_model.php');
    }
    
    public function index()
    {
        if(!isset($_GET['for']) || $_GET['for'] == '')
        {
            header('Location: ' . PATH);
            exit();
        }
        $this->searchArticle();
    }
    
    public function advanced()
    {
        if((!isset($_GET['any']) && !isset($_GET['each']) && !isset($_GET['none'])) || (trim($_GET['any']) == '' && trim($_GET['each']) == '' && trim($_GET['none']) == ''))
        {
            $data['header']['page_title'] = '';
            $data['content'] = '';
            $this->load->template('search_advanced.php', $data);
        }
        else
        {
            $any = trim($_GET['any']); $each = trim($_GET['each']); $none = trim($_GET['none']);
            if($each != '') { $each = '+(' . $each . ')'; }
            if($none != '') { $none = '+(' . $none . ')'; }
            $_GET['for'] = $each . ' ' . $none . ' ' . $any;
            $this->searchArticle();
            
        }
    }
    
    private function searchArticle()
    {
        if(isset($_GET['ajaxautocomplete']) && $_GET['ajaxautocomplete'] == TRUE)
        {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Content-type: application/json');
            $titles = $this->model->getTitles();
            echo json_encode($titles);
            die();
        }

        $articles = $this->model->getArticles();
        if($articles === FALSE)
        {
            $data['header']['page_title'] = Language::$search['title_not_found'];
            $data['content']['message'] = Language::$search['message'] . trim($_GET['for']);
            $this->load->template('message.php', $data);
        }
        else
        {
            $data['content'] = $articles;
            $data['header']['page_title'] = Language::$search['title'] . trim($_GET['for']);
            $data['content']['read'] = Language::$articles['read_more'];
            $data['content']['tags'] = Language::$articles['tags'];

            if(isset($_GET['order'], $_GET['desc']) && $_GET['order'] > 0 && $_GET['order'] < 5)
            {
                if($_GET['desc'] == 1)
                {
                    $class = 'down-arrow';
                }
                elseif($_GET['desc'] == 0)
                {
                    $class = 'up-arrow';
                }
                $data['content']['arrows'][$_GET['order'] - 1] = $class;
            }

            $this->load->template('search_view.php', $data);
        }
    }
    
}