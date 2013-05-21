<?php
class Home extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Home_model.php');
    }


    public function index()
    {
        $data = array();
		$data['header']['page_title'] = Language::$home['title'];
        $data['content'] = $this->model->getArticles();
		if(isset($data['content']['articles']))
		{
			$data['content']['tags'] = Language::$articles['tags'];
			$data['content']['read'] = Language::$articles['read_more'];
			$this->load->template('home_view.php', $data);
		}
		else
		{
			$data['content']['message'] = Language::$article_errors['no_articles'];
			$this->load->template('message_2.php', $data);
		}
    }
    
}