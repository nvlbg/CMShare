<?php
class Settings extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Settings_model.php');
    }
    
    public function index()
    {
        $data = array();
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE)
        {
            $data['header']['page_title'] = Language::$options['error']['title'];
            $data['content']['message'] = Language::$options['error']['message'];
            $this->load->template('message.php', $data);
        }
        else
        {
            $data['header']['page_title'] = Language::$options['index']['page_title'];
            $data['content'] = $this->model->getLastLogins();
            $data['content']['labels'] = Language::$options['labels'];
            
            $this->load->template('settings.php', $data);
        }
    }
    
    public function changepass()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE)
        {
            $this->index();
        }
        else
        {
            if(!isset($_POST['old-password'], $_POST['new-password'], $_POST['re-new-password']))
            {
                $this->index();
            }
            else
            {
                $data = array();
                $data['no_sections'] = TRUE;
                $data['header']['page_title'] = Language::$options['changepass']['page_title'];
                $data['content'] = $this->model->getLastLogins();
                $data['content']['labels'] = Language::$options['labels'];

                if(!$this->model->checkPasswords())
                {
                    $data['content']['changepass']['errors'][] = Language::$options['errors']['old_pass'];
                }
                if(!Validate::strlen_min($_POST['new-password'], 6))
                {
                    $data['content']['changepass']['errors'][] = Language::$options['errors']['pass_too_short'];
                }
                if(trim($_POST['new-password']) != trim($_POST['re-new-password']))
                {
                    $data['content']['changepass']['errors'][] = Language::$options['errors']['pwrds_not_same'];
                }

                if(isset($data['content']['changepass']['errors']))
                {
                    foreach($_POST as $k => $v)
                    {
                        $data['content']['input'][$k] = $v;
                    }
                }
                else
                {
                    if(!$this->model->changePassword())
                    {
                        $data['content']['changepass']['errors'][] = Language::$options['errors']['pwrds_unknown'];
                    }
                    else
                    {
                        $data['content']['changepass']['success'] = Language::$options['success']['pass'];
                    }
                }
                $this->load->template('settings.php', $data);
            }
        }
    }
    
    public function changeavatar()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE)
        {
            $this->index();
        }
        else
        {
            $data = array();
            
            $data['header']['page_title'] = Language::$options['new_avatar']['page_title'];
            $data['content'] = $this->model->getLastLogins();
            $data['content']['labels'] = Language::$options['labels'];
            $data['content']['new_avatar']['errors'] = array();
            
            if(isset($_FILES['u-avatar']))
            {
                if($_FILES['u-avatar']['error'] == UPLOAD_ERR_OK)
                {
                    if($_FILES['u-avatar']['size'] > 1048576)
                    {
                        $data['content']['new_avatar']['errors'][] = Language::$options['errors']['image_size'];
                    }

                    $type = $_FILES['u-avatar']['type'];
                    if($type != 'image/gif' && $type != 'image/png' && $type != 'image/jpeg' && $type != 'image/pjpeg')
                    {
                        $data['content']['new_avatar']['errors'][] = Language::$options['errors']['image_format'];
                    }

                    if(count($data['content']['new_avatar']['errors']) == 0)
                    {
                        $pathname = SPATH . 'img/avatars/' . $_SESSION['user_info']['user_id'] . '/';
                        
                        $ext = substr(strrchr($_FILES['u-avatar']['name'], '.'), 0);
                        $file = str_replace($ext, '', $_FILES['u-avatar']['name']);
                        $file = $pathname . '/original_' . $file;
                        unset($ext);
                        
                        if(!is_dir($pathname))
                        {
                            mkdir($pathname);
                        }
                        else
                        {
                            $dh = opendir($pathname);
                            while($img = readdir($dh))
                            {
                                if(!is_dir($img))
                                {
                                    @unlink($pathname . $img);
                                }
                            }
                            closedir($dh);
                        }

                        if(!move_uploaded_file($_FILES['u-avatar']['tmp_name'], $file))
                        {
                            $data['content']['new_avatar']['errors'][] = Language::$options['errors']['image_save'];
                        }
                        else
                        {
                            include SPATH . 'system/classes/Image.php';

                            Image::makeThumb($file, $pathname, 44);
                            Image::makeThumb($file, $pathname, 80);
                            Image::makeThumb($file, $pathname, 100);
                        }
                    }
                }
                else
                {
                    switch($_FILES['u-avatar']['error'])
                    {
                        case UPLOAD_ERR_INI_SIZE:
                        case UPLOAD_ERR_FORM_SIZE:
                            $data['content']['new_avatar']['errors'][] = Language::$options['errors']['image_size'];
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            $data['content']['new_avatar']['errors'][] = Language::$options['errors']['image_part'];
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            $data['content']['new_avatar']['errors'][] = Language::$options['errors']['no_image'];
                            break;
                        case UPLOAD_ERR_NO_TMP_DIR:
                        case UPLOAD_ERR_CANT_WRITE:
                        case UPLOAD_ERR_EXTENSION:
                            $data['content']['new_avatar']['errors'][] = Language::$options['errors']['unknown'];
                            include SPATH . 'sytem/classes/logging.php';

                            $err = '';

                            switch ($_FILES['u-avatar']['error'])
                            {
                                case UPLOAD_ERR_NO_TMP_DIR:
                                    $err = 'Missing a temporary folder.';
                                    break;
                                case UPLOAD_ERR_CANT_WRITE:
                                    $err = 'Failed to write file to disk.';
                                    break;
                                case UPLOAD_ERR_EXTENSION:
                                    $err = 'A PHP extension stopped the file upload.';
                                    break;
                            }

                            $err .= ' user_id : ' . $_SESSION['user_info']['user_id'];
                            $err .= ' username : ' . $_SESSION['user_info']['username'];

                            Logging::setFile('avatar_uploads');
                            Logging::write($err);
                            break;

                        default:
                            $data['content']['new_avatar']['errors'][] = Language::$options['errors']['unknown'];
                    }
                }

                if(isset($_GET['ajaxauto']))
                {
                    if(isset($data['content']['new_avatar']['errors']) && count($data['content']['new_avatar']['errors']) > 0)
                    {
                        echo $data['content']['new_avatar']['errors'][0];
                    }
                    else
                    {
                        echo -1;
                    }
                    die();
                }
            }
            
            $this->load->template('settings.php', $data);
        }
    }
    
    public function changeprofile()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE || !isset($_POST['check']) || $_POST['check'] != 1)
        {
            $this->index();
        }
        else
        {
            $data = array();
            $data['header']['page_title'] = Language::$options['changeprofile']['title'];
            $data['content'] = $this->model->getLastLogins();
            $data['content']['labels'] = Language::$options['labels'];

            if(isset($_POST['p-fname']) && $_POST['p-fname'] != '')
            {
                if($_SESSION['user_info']['fname'] != '')
                {
                    $data['content']['changeprofile']['errors'][] = Language::$options['errors']['cp_fname'];
                }
                elseif(Validate::name($_POST['p-fname']))
                {
                    if(!$this->model->updateFirst())
                    {
                        $data['content']['changeprofile']['errors'][] = Language::$options['errors']['cp_fname_uld'];
                    }
                    else
                    {
                        $data['content']['changeprofile']['success'][] = Language::$options['success']['fname'];
                    }
                }
                else
                {
                    $data['content']['changeprofile']['errors'][] = Language::$options['errors']['cp_fname_inv'];
                }
            }
            if(isset($_POST['p-lname']) && $_POST['p-lname'] != '')
            {
                if($_SESSION['user_info']['lname'] != '')
                {
                    $data['content']['changeprofile']['errors'][] = Language::$options['errors']['cp_lname'];
                }
                elseif(Validate::name($_POST['p-lname']))
                {
                    if(!$this->model->updateLast())
                    {
                        $data['content']['changeprofile']['errors'][] = Language::$options['errors']['cp_lname_uld'];
                    }
                    else
                    {
                        $data['content']['changeprofile']['success'][] = Language::$options['success']['lname'];
                    }
                }
                else
                {
                    $data['content']['changeprofile']['errors'][] = Language::$options['errors']['cp_lname_inv'];
                }
            }
            if(isset($_POST['p-desc']))
            {
                if(Validate::strlen($_POST['p-desc'], 400))
                {
                    if(!$this->model->updateDescription())
                    {
                        $data['content']['changeprofile']['errors'][] = Language::$options['errors']['cp_desc_unk'];
                    }
                    else
                    {
                        $data['content']['changeprofile']['success'][] = Language::$options['success']['desc'];
                    }
                }
                else
                {
                    $data['content']['changeprofile']['errors'][] = Language::$options['errors']['cp_desc_2_long'];
                }
            }
            
            if(isset($data['content']['changeprofile']['errors']))
            {
                foreach($_POST as $k => $v)
                {
                    $data['content']['inputs'][$k] = $v;
                }
            }

            $this->load->template('settings.php', $data);
        }
    }
    
}