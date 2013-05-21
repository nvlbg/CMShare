<?php
class Language
{

    public static $main_menu = array();
    public static $home = array();
    public static $articles = array();
    public static $foot = array();
    public static $article_errors = array();
    public static $category_errors = array();
    public static $contact = array();
    public static $contact_errors = array();
    public static $login_title = null;
    public static $login_form = array();
    public static $login_errors = array();
    public static $settings = null;
    public static $register_labels = array();
    public static $register = array();
    public static $reg_error = array();
    public static $search = array();
    public static $tag_errors = array();
    public static $comments = array();
    public static $user_not_found = array();
    public static $users = array();
    public static $gender = array();
    public static $permissions = array();
    public static $pm = array();
    public static $options = array();
    public static $install = array();
    public static $sections = array();
    public static $admin = array();
    
    public static function init()
    {
        self::$login_title                         = 'Login';
        self::$settings                            = 'Settings';

        self::$main_menu['search']                 = 'Search...';
        self::$main_menu['submit']                 = 'Search!';
        
        self::$home['title']                       = 'Welcome!';
        
        self::$articles['tags']                    = 'Tags: ';
        self::$articles['read_more']               = 'read more &raquo;';
        self::$articles['comments']                = ' comments for this post:';
        self::$articles['no_comments']             = 'No comments for this post.';
        
        self::$article_errors['title']             = 'Article not found.';
        self::$article_errors['message']           = 'Sorry, but the article that you are trying to access is not found.';
        self::$article_errors['no_articles']       = 'There are no articles.';
        
        self::$category_errors['title']            = 'Category not found.';
        self::$category_errors['message']          = 'Sorry, but the category that you are trying to access is not found.';
        self::$category_errors['no_articles']      = 'There are no articles with this tag.';
        
        self::$contact['page_title']               = 'Contact me';
        self::$contact['name']                     = 'Name';
        self::$contact['email']                    = 'Email';
        self::$contact['title']                    = 'Title';
        self::$contact['message']                  = 'Message';
        self::$contact['succeeded_message']        = 'Your message has been sent successfully.';
        
        self::$contact_errors['name']              = 'The name field is required.';
        self::$contact_errors['title']             = 'The title field is required.';
        self::$contact_errors['message']           = 'The message field is required.';
        self::$contact_errors['email']             = 'Invalid email.';
        self::$contact_errors['unknown_title']     = 'Error';
        self::$contact_errors['unknown_message']   = 'Error. Please, try again later.';
        
        self::$login_form['username']              = 'Username';
        self::$login_form['password']              = 'Password';
        self::$login_form['register']              = 'Register!';
        self::$login_form['login']                 = 'Login';
        
        self::$login_errors['title']               = 'Login error.';
        self::$login_errors['wrong']               = 'Wrong username or password. Please, try again or <a href="' . PATH . 'register/" title="Register">register here</a> for free.';
        self::$login_errors['logged_in']           = 'You are logged in. You cannot register while you are logged in.';
        
        self::$register_labels['username']         = 'Username';
        self::$register_labels['password']         = 'Password';
        self::$register_labels['re-pass']          = 'Retype password';
        self::$register_labels['email']            = 'Email address';
        self::$register_labels['re-email']         = 'Retype email address';
        self::$register_labels['first-name']       = 'First name';
        self::$register_labels['last-name']        = 'Last name';
        self::$register_labels['sex']              = 'Sex';
        self::$register_labels['male']             = 'Male';
        self::$register_labels['female']           = 'Female';
        self::$register_labels['desc']             = 'Description';
        self::$register_labels['submit']           = 'Register';
        
        self::$register['message']                 = 'Congratulations! You are now registred. You can login from the form above.';
        self::$register['title']                   = 'Register!';
        self::$register['error']                   = 'Register error';
        
        self::$reg_error[]                         = 'The username is too short. The minimum number of characters is 4.';
        self::$reg_error[]                         = 'The username is too long. The maximum number of characters is 32.';
        self::$reg_error[]                         = 'Invalid username. Username must contain at least one letter.';
        self::$reg_error[]                         = 'Invalid username. Allowed characters are letters, numbers and _.';
        self::$reg_error[]                         = 'Sorry, the username is already taken.';
        self::$reg_error[]                         = 'The username and the password should not match.';
        self::$reg_error[]                         = 'The password is too short. The minimum lenght of password is 6 characters.';
        self::$reg_error[]                         = 'The password should contain at least one number/letter.';
        self::$reg_error[]                         = 'The passwords do not match.';
        self::$reg_error[]                         = 'The email is too long. Maximum 50 characters.';
        self::$reg_error[]                         = 'Invalid email.';
        self::$reg_error[]                         = 'The emails do not match.';
        self::$reg_error[]                         = 'Sorry, the email is already taken.';
        self::$reg_error[]                         = 'Invalid name. It is too long. Maximun 20 characters.';
        self::$reg_error[]                         = 'Invalid name.';
        self::$reg_error[]                         = 'Invalid sex.';
        self::$reg_error[]                         = 'The description is too long. The maximum lenght is 400 characters.';
        self::$reg_error[]                         = 'There was a problem while we were registering you. You can try again later, or notify the admins via the contact form.';
        
        self::$search['title']                     = 'Search - ';
        self::$search['title_not_found']           = 'Search - not found';
        self::$search['message']                   = 'There are no results for ';
        
        self::$tag_errors['tag_not_found_title']   = 'Tag not found.';
        self::$tag_errors['tag_not_found_message'] = 'Sorry, but the tag that you are trying to access is not found.';
        self::$tag_errors['no_articles']           = 'There are no articles with this tag.';
        
        self::$comments['no-comment']              = 'Please, write a comment.';
        self::$comments['too-long']                = 'The comment is too long. Maximum 400 characters.';
        self::$comments['invalid-name']            = 'Invalid name.';
        self::$comments['invalid-email']           = 'Invalid email.';

        self::$user_not_found['title']             = 'User not found';
        self::$user_not_found['message']           = 'Invalid id. The user that you are looking for is not found.';
        
        self::$users['title']                      = 'User profile - ';
        self::$users['labels']['registered_on']    = 'Registered on: ';
        self::$users['labels']['sex']              = 'Sex: ';
        self::$users['labels']['first']            = 'First name: ';
        self::$users['labels']['last']             = 'Last name: ';
        self::$users['labels']['comms']            = 'Comments: ';
        self::$users['labels']['permissons']       = 'Permissions: ';
        self::$users['labels']['pm']               = 'Send PM';
        self::$users['labels']['friend']           = 'Friend';
        self::$users['labels']['block']            = 'Block';
        self::$users['labels']['online']            = 'online';
        
        self::$gender['male']                      = 'Male';
        self::$gender['female']                    = 'Female';
        
        self::$permissions['n']                    = 'Normal User';
        self::$permissions['m']                    = 'Moderator';
        self::$permissions['a']                    = 'Administrator';
        
        self::$pm['no_message_title']              = 'No message';
        self::$pm['no_message_message']            = 'You have no message with such id.';
        self::$pm['none_title']                    = 'No messages';
        self::$pm['none_message']                  = 'You have no messages';
        self::$pm['no_messages_title']             = 'No messages';
        self::$pm['no_messages_message']           = 'No messages here';
        self::$pm['none_sent_title']               = 'Messages - none';
        self::$pm['none_sent_message']             = 'You have not sent any message yet.';
        self::$pm['sent_title']                    = 'Sent messages';
        self::$pm['inbox_title']                   = 'Inbox';
        self::$pm['title']                         = 'Messages';
        self::$pm['menu']['inbox']                 = 'Inbox';
        self::$pm['menu']['read']                  = 'Read';
        self::$pm['menu']['unread']                = 'Unread';
        self::$pm['menu']['sent']                  = 'Sent';
        self::$pm['delete']                        = 'Delete';
        self::$pm['send_title']                    = 'Sending a message';
        
        self::$pm['send_errors']['no_title']       = 'The title is empty';
        self::$pm['send_errors']['no_message']     = 'The message is empty';
        self::$pm['send_errors']['no_reciever']    = 'You haven\'t selected a reciever';
        self::$pm['send_errors']['no_user']        = 'There isn\'t a user with that username';
        self::$pm['send_success']                  = 'You have sent the message';

        self::$pm['send']['error_title']           = 'Error sending message';
        self::$pm['send']['error_message']         = 'You cannot send message to yourself.';
        
        self::$options['error']['title']           = 'Error setting profile';
        self::$options['error']['message']         = 'You are not logged in but you must be to set up your account.';

        self::$options['index']['page_title']      = 'Settings';
        self::$options['changepass']['page_title'] = 'Change password';
        self::$options['changeprofile']['title']   = 'Change profile info';
        self::$options['new_avatar']['page_title'] = 'Change avatar';

        self::$options['labels']['l']['password']  = 'Change password';
        self::$options['labels']['l']['profile']   = 'Change profile info';
        self::$options['labels']['l']['avatar']    = 'Change avatar';
        self::$options['labels']['l']['logins']    = 'Last five logins';

        self::$options['labels']['pw']['old']      = 'Old password';
        self::$options['labels']['pw']['new']      = 'New password';
        self::$options['labels']['pw']['re-new']   = 'Retype new password';
        self::$options['labels']['pw']['submit']   = 'Change password';

        self::$options['labels']['pr']['fname']    = 'First name';
        self::$options['labels']['pr']['lname']    = 'Last name';
        self::$options['labels']['pr']['desc']     = 'Description';
        self::$options['labels']['pr']['submit']   = 'Update profile';

        self::$options['labels']['a']['new']       = 'New avatar';
        self::$options['labels']['a']['allowed']   = 'Allowed formats are jpg, png and gif with maximum file size of 1 MB and maximum resolution of 1024x1024.';
        self::$options['labels']['a']['sqare']     = 'Square';
        self::$options['labels']['a']['submit']    = 'Change avatar';

        self::$options['labels']['ll']['time']     = 'Time';
        self::$options['labels']['ll']['ip']       = 'IP';

        self::$options['errors']['old_pass']       = 'The old password does not match your current password.';
        self::$options['errors']['pass_too_short'] = 'The new password is too short. Minimum 6 characters.';
        self::$options['errors']['pwrds_not_same'] = 'The passwords does not match.';
        self::$options['errors']['pwrds_unknown']  = 'There was an unknown problem changing your password. Please, try again or contact to the site owner.';

        self::$options['errors']['cp_fname']       = 'You cannot change your first name, because you have already added it.';
        self::$options['errors']['cp_fname_inv']   = 'Your first name is not valid.';
        self::$options['errors']['cp_fname_uld']   = 'There was an unknown error while adding your first name to your profile. Please, try again or contact to the site owner.';
        self::$options['errors']['cp_lname']       = 'You cannot change your last name, because you have already added it.';
        self::$options['errors']['cp_lname_inv']   = 'Your last name is not valid.';
        self::$options['errors']['cp_lname_uld']   = 'There was an unknown error while adding your last name to your profile. Please, try again or contact to the site owner.';
        self::$options['errors']['cp_desc_2_long'] = 'Your description is too long. It must not be longer than 400 characters.';
        self::$options['errors']['cp_desc_unk']    = 'There was an unknown error while adding/changing your description. Please, try again or contact to the site owner.';
        self::$options['errors']['image_size']     = 'Your avatar is too big. It must not be more than 1MB.';
        self::$options['errors']['image_format']   = 'Your image format is not supported. It must be .jpg, .png or .gif.';
        self::$options['errors']['image_save']     = 'There was an error with saving your avatar. Please, try again later or contact to the site owner.';
        self::$options['errors']['image_part']     = 'The uploaded avatar was only partially uploaded.';
        self::$options['errors']['no_image']       = 'You haven\'t uploaded any image.';
        self::$options['errors']['unknown']        = 'There was unknown error. Please, try again later or contact the admins.';

        self::$options['success']['pass']          = 'Your password have been changed.';
        self::$options['success']['fname']         = 'Your first name has been added.';
        self::$options['success']['lname']         = 'Your last name has been added.';
        self::$options['success']['desc']          = 'Your description is changed.';

        self::$install['step'][1]                  = 'DB configuration';
        self::$install['step'][2]                  = 'Site configuration';
        self::$install['step'][3]                  = 'Administration';

        self::$install['mysql']['mysql-server']    = 'You should be able to get this info from your web host.';
        self::$install['mysql']['mysql-user']      = 'Your database username.';
        self::$install['mysql']['mysql-pass']      = 'Your password for connecting the database.';
        self::$install['mysql']['mysql-db']        = 'The name of the database you want to use. If it does not exists, I will create it for you.';
        self::$install['site']['site-name']        = 'You can change it later.';
        self::$install['site']['index-page']       = 'Whcih page to load first, when someone opens your site. Default: home';
        //self::$install['site']['admin-name']       = 'Your nickname.';
        //self::$install['site']['admin-pass']       = 'Your password.';
        self::$install['site']['path']             = 'Usually your domain name. It\'s important for loading images, submitting forms and other stuff. e.g. http://www.example.com/';
        self::$install['site']['timezone']         = 'The timezone the site should be';
        self::$install['errors'][1]                = 'It seems that you don\'t have mysqli extension of PHP installed. Please, install it and try again.';
        self::$install['errors'][2]                = 'Error. Cannot connect to database. Please, check your settings again.';
        self::$install['errors'][3]                = 'Error. The database name is invalid. It must be less than 64 characters and can contain numbers, letters, $ and _';
        self::$install['errors'][4]                = 'Error. Cannot save config file.';
        self::$install['errors'][5]                = 'Sorry, but the default page you provided could not be found.';
        self::$install['errors'][6]                = 'Invalid path to site. Example: <b>http://www.yoursite.com/</b>';
        self::$install['errors'][7]                = 'There is no such timezone. You can see the available timezones <a href="http://www.php.net/manual/en/timezones.php">here</a>';
        self::$install['errors'][8]                = 'Admin name is invalid. It must be between 4 and 32 characters';
        self::$install['errors'][9]                = 'Password is too short.';
        self::$install['errors'][10]               = 'Invalid sex';
        self::$install['next']                     = 'Next';
        self::$install['finish']                   = 'Finish';
        self::$install['install_finished_message'] = 'You have installed the site.';
        self::$install['title']['database']        = 'Database installation';
        self::$install['title']['site']            = 'Site configuration';
        self::$install['title']['admin']           = 'Administration info';
        self::$install['title']['success']         = 'Finish';
        self::$install['success_message']          = 'Congratulations! The site is configured properly. If you want to enter the admin panel go to ' . PATH . 'admin/';

        self::$sections['categories']['title']     = 'Categories';
        self::$sections['tags']['title']           = 'Tags';

        self::$admin['verify']['page_title']       = 'Admin panel log in';
        self::$admin['verify']['admin_name']       = 'Admin username';
        self::$admin['verify']['admin_pass']       = 'Admin password';
        self::$admin['verify']['submit']           = 'Submit';
        self::$admin['verify']['error']            = 'Admin name or password is incorrect.';

        self::$admin['labels_header']['article']   = 'Article';
        self::$admin['labels_header']['category']  = 'Add category';
        self::$admin['labels_header']['users']     = 'Users';
        self::$admin['labels_header']['settings']  = 'Settings';

        self::$admin['labels_header']['article_w'] = 'Write';
        self::$admin['labels_header']['article_e'] = 'Edit';
        self::$admin['labels_header']['users_a']   = 'Add';
        self::$admin['labels_header']['users_e']   = 'Edit';
        self::$admin['labels_header']['appear']    = 'Appearance';

        self::$admin['labels_footer']['users']     = 'Last users';
        self::$admin['labels_footer']['comments']  = 'Last comments';

        self::$admin['settings']['l']['title']     = 'General settings';
        self::$admin['settings']['l']['posts']     = 'Posts per pages';
        self::$admin['settings']['l']['timezone']  = 'Default timezone';
        self::$admin['settings']['l']['control']   = 'Default controller';
        self::$admin['settings']['l']['footer']    = 'Site\'s footer';

        self::$admin['settings']['err']['control'] = 'The controller does not exist.';
        self::$admin['settings']['err']['pages']   = 'The value for posts per pages is invalid.';
        self::$admin['settings']['err']['zone']    = 'There is no such timezone. You can see the available timezones <a href="http://www.php.net/manual/en/timezones.php">here</a>';
        
        self::$admin['settings']['l']['save']      = 'Save';
        
        self::$admin['article_w_l']['title']       = 'Title';
        self::$admin['article_w_l']['article']     = 'Article';
        self::$admin['article_w_l']['category']    = 'Category';
        self::$admin['article_w_l']['tags']        = 'Tags';
        self::$admin['article_w_l']['tags_hint']   = 'Seperate tags with space (" ")';
        self::$admin['article_w_l']['edit_coms']   = 'Edit comments here';
        self::$admin['article_w_l']['reset']       = 'Reset counter';
        self::$admin['article_w_l']['post']        = 'Post';
        self::$admin['article_w_l']['edit']        = 'Edit';
        
        self::$admin['article_w']['title']         = 'New article';
        self::$admin['article_e']['title_ts']      = 'The title is too short. Minimum 4 letters.';
        self::$admin['article_e']['title_tl']      = 'The title is too long. Maximum 55 letters.';
        self::$admin['article_e']['no_cat']        = 'There is no such category.';
        self::$admin['article_e']['no_tags']       = 'There are no tags.';
        self::$admin['article_e']['not_valid']     = 'The request was not valid. Please, try again.';
        self::$admin['article_e']['no_perm']       = 'This articles isn\'t yours. You have no permissions to edit it.';
        self::$admin['article_e']['success']       = 'You have saved the article.';
        
        self::$admin['eal']['title']               = 'Edit articles';
        self::$admin['eal_labels']['title']        = 'Article title';
        self::$admin['eal_labels']['edit']         = 'Edit';
        self::$admin['eal_labels']['delete']       = 'Delete selected articles';
        
        self::$admin['users_edit']['title']        = 'Edit users';
        self::$admin['users_edit']['username']     = 'Username';
        self::$admin['users_edit']['edit']         = 'Edit';
        self::$admin['users_edit']['delete']       = 'Delete selected users';
        
        self::$admin['user_edit']['user_id']       = 'User ID';
        self::$admin['user_edit']['username']      = 'Username';
        self::$admin['user_edit']['email']         = 'Email';
        self::$admin['user_edit']['sex']           = 'Sex';
        self::$admin['user_edit']['fname']         = 'First name';
        self::$admin['user_edit']['lname']         = 'Last name';
        self::$admin['user_edit']['desc']          = 'Description';
        self::$admin['user_edit']['permissions']   = 'Permissions';
        self::$admin['user_edit']['normal']        = 'Normal';
        self::$admin['user_edit']['moderator']     = 'Moderator';
        self::$admin['user_edit']['rem-avatar']    = 'Remove avatar?';
        self::$admin['user_edit']['yes']           = 'Yes';
        self::$admin['user_edit']['button']        = 'Edit user';
        
        self::$admin['ue_errors']['fn_tl']         = 'The first name is too long.';
        self::$admin['ue_errors']['fn_invalid']    = 'The first name is invalid.';
        self::$admin['ue_errors']['ln_tl']         = 'The last name is too long.';
        self::$admin['ue_errors']['ln_invalid']    = 'The last name is invalid.';
        self::$admin['ue_errors']['desc']          = 'The description is too long. Maximum 400 characters.';
        self::$admin['ue_errors']['unknown']       = 'There was an unknown error. Please, try again!';
        self::$admin['ue_errors']['success']       = 'The user profile has been edited.';
        
        self::$admin['user_add']['title']          = 'Add user';
        self::$admin['user_add']['permissions']    = 'Permissions';
        self::$admin['user_add']['moderator']      = 'Moderator';
        self::$admin['user_add']['normal']         = 'Normal';
        self::$admin['user_add']['add']            = 'Add user';
        self::$admin['user_add']['success']        = 'You have successfully added an user.';
        
        self::$admin['feedback']['title']          = 'Feedback';
        self::$admin['feedback']['from']           = 'From: ';
        self::$admin['feedback']['email']          = 'Email: ';
        
        self::$admin['add_category']['no_cats']    = 'There are no categories. Make some <a href="'. PATH . 'admin/add_category/">here</a>';
        self::$admin['add_category']['title']      = 'Add category';
        self::$admin['add_category']['l']['name']  = 'Category name';
        self::$admin['add_category']['l']['add']   = 'Add category';
        self::$admin['add_category']['success']    = 'You have added a category';
        self::$admin['errors']['unknown']          = 'You may already added the category. Please, check and try again';
        self::$admin['errors']['too_long']         = 'The category name must not be empty or longer than 32 characters';
        self::$admin['errors']['cat_exists']       = 'This category already exists';
		
        self::$admin['appearance']['title']        = 'Appearance';

        self::$admin['edit_comments_title']        = 'Edit comments';
    }
    
}