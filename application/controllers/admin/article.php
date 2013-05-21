<?php
class Article extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Article_admin.php');
    }
    
    public function index()
    {
        header("Location: " . PATH . 'admin/article/write/');
        exit();
    }
    
    public function write()
    {
        $data = array();
        
        $data['header']['title'] = Language::$admin['article_w']['title'];
        
        $data['content']['labels'] = Language::$admin['article_w_l'];
        $data['content']['cats'] = $this->model->getCategories();
		$data['content']['categories_error'] = Language::$admin['add_category']['no_cats'];
        
        if(isset($_POST['title'], $_POST['article'], $_POST['category'], $_POST['tags'], $_POST['check']))
        {
            $data['content']['errors'] = array();
            
            if($_POST['check'] == $_SESSION['check'])
            {
                if(!Validate::strlen_min($_POST['title'], 4))
                {
                    $data['content']['errors'][] = Language::$admin['article_e']['title_ts'];
                }
                elseif(!Validate::strlen($_POST['title'], 56))
                {
                    $data['content']['errors'][] = Language::$admin['article_e']['title_tl'];
                }

                if(!$this->model->isValidCategory($_POST['category']))
                {
                    $data['content']['errors'][] = Language::$admin['article_e']['no_cat'];
                }

                if(!strlen(trim($_POST['tags'])) > 0)
                {
                    $data['content']['errors'][] = Language::$admin['article_e']['no_tags'];
                }

                if(count($data['content']['errors']) == 0)
                {
                    $this->model->saveArticle();
                    $data['content']['success'] = Language::$admin['article_e']['success'];
                }
            }
            else
            {
                $data['content']['errors'][] = Language::$admin['article_e']['not_valid'];
            }
            
            
            if(count($data['content']['errors']) > 0)
            {
                foreach($_POST as $k=>$v)
                {
                    $data['content']['inputs'][$k] = $v;
                }
            }
        }
        
        
        $_SESSION['check'] = time();
        $data['content']['check'] = $_SESSION['check'];
        
        $this->load->admin_template('new_article.php', $data);
    }
    
    public function edit()
    {
        $data = array();
        
        if(isset($_POST['title'], $_POST['article'], $_POST['category'], $_POST['tags'], $_POST['article_id'], $_POST['check']) && is_numeric($_POST['article_id']))
        {
            $errors = array();
            
            if($_POST['check'] == $_SESSION['check'])
            {
                if(!Validate::strlen_min($_POST['title'], 4))
                {
                    $errors[] = Language::$admin['article_e']['title_ts'];
                }
                elseif(!Validate::strlen($_POST['title'], 56))
                {
                    $errors[] = Language::$admin['article_e']['title_tl'];
                }

                if(!$this->model->isValidCategory($_POST['category']))
                {
                    $errors[] = Language::$admin['article_e']['no_cat'];
                }

                if(!strlen(trim($_POST['tags'])) > 0)
                {
                    $errors[] = Language::$admin['article_e']['no_tags'];
                }

                if(count($errors) == 0)
                {
                    try {
                        $this->model->edit( $_POST['article_id'] );
                        $success = Language::$admin['article_e']['success'];
                    } catch (Exception $e) {
                        $errors[] = Language::$admin['article_e']['no_perm'];
                    }
                }
            }
            else
            {
                $errors[] = Language::$admin['article_e']['not_valid'];
            }
            
            $data['content'] = $this->model->getArticle( $_POST['article_id'] );
            
            if(count($errors) > 0)
            {
                $data['content']['inputs'] = array();
                $data['content']['errors'] = $errors;
                foreach($_POST as $k=>$v)
                {
                    $data['content']['inputs'][$k] = $v;
                }
            }
            
            if(isset($success))
            {
                $data['content']['success'] = $success;
            }
            
            $_SESSION['check'] = time();
            $data['content']['check'] = $_SESSION['check'];
            
            $data['header']['title'] = $data['content']['title'];
            $data['content']['labels'] = Language::$admin['article_w_l'];
            
            $this->load->admin_template('edit_article.php', $data);
        }
        elseif(is_numeric($this->segment(4)) && $this->model->articleExists( $this->segment(4) ))
        {
            $data['content'] = $this->model->getArticle( $this->segment(4) );
            $data['header']['title'] = $data['content']['title'];
            $data['content']['labels'] = Language::$admin['article_w_l'];
            
            $_SESSION['check'] = time();
            $data['content']['check'] = $_SESSION['check'];
            
            $this->load->admin_template('edit_article.php', $data);
        }
        else
        {
            $data['header']['title'] = Language::$admin['eal']['title'];
            $data['content'] = $this->model->getArticles();
            if(!isset($data['content']['articles']))
            {
                    $data['content']['articles'] = array();
            }
            $data['content']['labels'] = Language::$admin['eal_labels'];
            
            $_SESSION['check'] = time();
            $data['content']['check'] = $_SESSION['check'];
            
            $this->load->admin_template('edit_articles.php', $data);
        }
    }
    
    public function delete()
    {
        if(isset($_POST['delete']) && count($_POST['delete']) > 0)
        {
            $this->model->deleteArticles($_POST['delete']);
        }
        
        header('Location: ' . PATH . 'admin/article/edit/');
        exit();
    }

}