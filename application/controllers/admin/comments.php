<?php
class Comments extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Comments_admin.php');
    }
    
    public function index()
    {
        header('Location: ' . PATH . 'admin/');
        exit();
    }
    
    public function article()
    {
        if(!is_numeric($this->segment(4)) || (int) $this->segment(4) < 1 || !$this->model->articleExists($this->segment(4)))
        {
            header('Location: ' . PATH . 'admin/');
            exit();
        }

        $comments = $this->model->getArticleComments($this->segment(4));
        $this->loadView($comments);
    }
    
    public function user()
    {
        if(!is_numeric($this->segment(4)) || (int) $this->segment(4) < 1 || !$this->model->userExists($this->segment(4)))
        {
            header('Location: ' . PATH . 'admin/');
            exit();
        }

        $comments = $this->model->getUserComments($this->segment(4));
        $this->loadView($comments);
    }

    public function edit()
    {
        if(!is_numeric($this->segment(4)) || (int) $this->segment(4) < 1 || !$this->model->commentExists($this->segment(4)))
        {
            header('Location: ' . PATH . 'admin/');
            exit();
        }

        if(isset($_POST['comment']) && $this->model->commentExists($this->segment(4)))
        {
            $this->model->updateComment($_POST['comment'], $this->segment(4));
        }

        $data = array();
        $data['header']['title'] = Language::$admin['edit_comments_title'];
        $data['content']['comment'] = $this->model->getComment($this->segment(4));
        $data['content']['id'] = (int) $this->segment(4);
        $data['content']['edit'] = Language::$admin['article_w_l']['edit'];

        $this->load->admin_template('edit_comment.php', $data);
    }

    private function loadView($comments = array())
    {
        $data = array();
        
        $data['header']['title'] = Language::$admin['edit_comments_title'];
        $data['content'] = array();
        $data['content']['comments'] = $comments;
        $data['content']['edit'] = Language::$admin['article_w_l']['edit'];
        
        $this->load->admin_template('edit_comments.php', $data);
    }
    
}