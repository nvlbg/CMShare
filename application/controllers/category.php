<?php
class Category extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Category_model.php');
    }
    public function index()
    {
        $data = array();
        $category = $this->model->getCategory();
        if($category !== FALSE)
        {
            $data['header']['page_title'] = 'Category - ' . $category['category_name'];
            $data['content'] = $category;
            $data['content']['read'] = Language::$articles['read_more'];
            $data['content']['tags_m'] = Language::$articles['tags'];
            $data['content']['no_articles'] = Language::$category_errors['no_articles'];
            $this->load->template('category_view.php', $data);
        }
        else
        {
            $data['header']['page_title'] = Language::$category_errors['title'];
            $data['content']['message'] = Language::$category_errors['message'];
            $this->load->template('message.php', $data);
        }
        
    }
    
}