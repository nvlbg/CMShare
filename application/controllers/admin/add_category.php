<?php
class Add_category extends Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->model = $this->load->model('Admin_category.php');
	}
	
	public function index()
	{
		$data = array();
		
		$data['header']['title'] = Language::$admin['add_category']['title'];
		$data['content'] = array();
		$data['content']['labels'] = Language::$admin['add_category']['l'];
		
		if(isset($_POST['category'], $_POST['check']))
		{
			$errors = array();
			
			if($_POST['check'] != $_SESSION['check'])
			{
				$errors[] = Language::$admin['errors']['unknown'];
			}
			else
			{
				if(strlen(trim($_POST['category'])) == 0 || !Validate::strlen($_POST['category'], 32))
				{
					$errors[] = Language::$admin['errors']['too_long'];
				}
				else
				{
					if($this->model->categoryExists($_POST['category']))
					{
						$errors[] = Language::$admin['errors']['cat_exists'];
					}
					else
					{
						$this->model->addCategory($_POST['category']);
					}
				}
			}
			
			if(count($errors) > 0)
			{
				$data['content']['errors'] = $errors;
				$data['content']['input']['category'] = $_POST['category'];
			}
			else
			{
				$data['content']['success'] = Language::$admin['add_category']['success'];
			}
		}
		
		$_SESSION['check'] = time();
		$data['content']['check'] = $_SESSION['check'];
		
		$this->load->admin_template('add_category.php', $data);
	}
	
}