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
        self::$login_title                         = 'Вход';
        self::$settings                            = 'Настройки';

        self::$main_menu['search']                 = 'Търси...';
        self::$main_menu['submit']                 = 'Търси!';

        self::$home['title']                       = 'Добре дошли!';

        self::$articles['tags']                    = 'Етикети: ';
        self::$articles['read_more']               = 'прочетете повече &raquo;';
        self::$articles['comments']                = ' коментари за този пост:';
        self::$articles['no_comments']             = 'Няма коментари за този пост.';

        self::$article_errors['title']             = 'Статията не е намерена.';
        self::$article_errors['message']           = 'Съжаляваме, но статията, която се опитвате да прочетете, не беше открита.';
        self::$article_errors['no_articles']       = 'Няма статии.';

        self::$category_errors['title']            = 'Категорията не беше открита.';
        self::$category_errors['message']          = 'Съжаляваме, но категорията, която се опитвате да прочетете, не беше открита.';
        self::$category_errors['no_articles']      = 'Няма статии с този етикет.';

        self::$contact['page_title']               = 'Свържете се с мен';
        self::$contact['name']                     = 'Име';
        self::$contact['email']                    = 'Имейл';
        self::$contact['title']                    = 'Заглавие';
        self::$contact['message']                  = 'Съобщение';
        self::$contact['succeeded_message']        = 'Съобщението Ви беше изпратено успешно.';

        self::$contact_errors['name']              = 'Полето за име е задължително.';
        self::$contact_errors['title']             = 'Полето за заглавие е задължително.';
        self::$contact_errors['message']           = 'Полето за съобщение е задължително.';
        self::$contact_errors['email']             = 'Грешен имейл.';
        self::$contact_errors['unknown_title']     = 'Грешка';
        self::$contact_errors['unknown_message']   = 'Грешка. Моля, опитайте отново по-късно.';

        self::$login_form['username']              = 'Потребителско име';
        self::$login_form['password']              = 'Парола';
        self::$login_form['register']              = 'Регистрация!';
        self::$login_form['login']                 = 'Вход';

        self::$login_errors['title']               = 'Грешка при влизане.';
        self::$login_errors['wrong']               = 'Грешно потребителско име или парола. Моля, опитайте отново или <a href="' . PATH . 'register/" title="Register">register here</a> безплатно.';
        self::$login_errors['logged_in']           = 'Вие сте влезли в системата. Не може да се регистрирате, докато все още сте вътре в системата.';

        self::$register_labels['username']         = 'Потребителско име';
        self::$register_labels['password']         = 'Парола';
        self::$register_labels['re-pass']          = 'Повторете паролата';
        self::$register_labels['email']            = 'Имейл адрес';
        self::$register_labels['re-email']         = 'Повторете имейл адреса';
        self::$register_labels['first-name']       = 'Име';
        self::$register_labels['last-name']        = 'Фамилия';
        self::$register_labels['sex']              = 'Пол';
        self::$register_labels['male']             = 'Мъж';
        self::$register_labels['female']           = 'Жена';
        self::$register_labels['desc']             = 'Описание';
        self::$register_labels['submit']           = 'Регистрация';

        self::$register['message']                 = 'Поздравления! Вече сте регистриран/а. Може да влезете чрез формата по-горе.';
        self::$register['title']                   = 'Регистрация!';
        self::$register['error']                   = 'Грешка при регистрацията';

        self::$reg_error[]                         = 'Потребителското име е твърде кратко. Минимумът е 4 знака.';
        self::$reg_error[]                         = 'Потребителското име е твърде дълго. Максимумът е 32 знака.';
        self::$reg_error[]                         = 'Невалидно потребителско име. Потребителското име трябва да съдържа поне една буква.';
        self::$reg_error[]                         = 'Невалидно потребителско име. Позволените знаци са букви, цифри и _.';
        self::$reg_error[]                         = 'Съжаляваме, потребителското име вече е заето.';
        self::$reg_error[]                         = 'Потребителското име и паролата не може да съвпадат.';
        self::$reg_error[]                         = 'Паролата е твърде кратка. Минималната дължина на паролата е 6 знака.';
        self::$reg_error[]                         = 'Паролата трябва да съдържа поне едно число/буква.';
        self::$reg_error[]                         = 'Паролите не съвпадат.';
        self::$reg_error[]                         = 'Имейлът е твърде дълъг. Максимумът е 50 знака.';
        self::$reg_error[]                         = 'Невалиден имейл.';
        self::$reg_error[]                         = 'Имейлите не съвпадат.';
        self::$reg_error[]                         = 'Съжаляваме, имейлът вече е зает.';
        self::$reg_error[]                         = 'Невалидно име. Твърде дълго е. Максимумът е 20 знака.';
        self::$reg_error[]                         = 'Невалидно име.';
        self::$reg_error[]                         = 'Невалиден пол.';
        self::$reg_error[]                         = 'Описанието е твърде дълго. Максималната дължина е 400 знака.';
        self::$reg_error[]                         = 'Възникна проблем при регистрацията. Може да опитате отново по-късно или да уведомите администраторите чрез контактната форма.';

        self::$search['title']                     = 'Търсене - ';
        self::$search['title_not_found']           = 'Търсене - не беше намерено';
        self::$search['message']                   = 'Няма резултати за ';

        self::$tag_errors['tag_not_found_title']   = 'Етикетът не беше открит.';
        self::$tag_errors['tag_not_found_message'] = 'Съжаляваме, но етикетът не беше открит.';
        self::$tag_errors['no_articles']           = 'Няма статии с този етикет.';

        self::$comments['no-comment']              = 'Моля, напишете коментар.';
        self::$comments['too-long']                = 'Коментарът е твърде дълъг. Максимумът е 400 знака.';
        self::$comments['invalid-name']            = 'Невалидно име.';
        self::$comments['invalid-email']           = 'Невалиден имейл.';

        self::$user_not_found['title']             = 'Потребителят не беше открит.';
        self::$user_not_found['message']           = 'Невалидно id. Потребителят, когото търсите, не беше открит.';

        self::$users['title']                      = 'Потребителски профил - ';
        self::$users['labels']['registered_on']    = 'Регистриран на: ';
        self::$users['labels']['sex']              = 'Пол: ';
        self::$users['labels']['first']            = 'Име: ';
        self::$users['labels']['last']             = 'Фамилия: ';
        self::$users['labels']['comms']            = 'Коментари: ';
        self::$users['labels']['permissons']       = 'Права: ';
        self::$users['labels']['pm']               = 'Изпратете ЛС';
        self::$users['labels']['friend']           = 'Приятел';
        self::$users['labels']['block']            = 'Блокирайте';
        self::$users['labels']['online']            = 'на линия';

        self::$gender['male']                      = 'Мъж';
        self::$gender['female']                    = 'Жена';

        self::$permissions['n']                    = 'Нормален потребител';
        self::$permissions['m']                    = 'Модератор';
        self::$permissions['a']                    = 'Администратор';

        self::$pm['no_message_title']              = 'Няма съобщение';
        self::$pm['no_message_message']            = 'Нямате съобщение с такова id.';
        self::$pm['none_title']                    = 'Няма съобщения';
        self::$pm['none_message']                  = 'Нямате съобщения';
        self::$pm['no_messages_title']             = 'Няма съобщения';
        self::$pm['no_messages_message']           = 'Тук няма съобщения';
        self::$pm['none_sent_title']               = 'Съобщения - няма';
        self::$pm['none_sent_message']             = 'Все още не сте изпращали съобщения.';
        self::$pm['sent_title']                    = 'Изпратени съобщения';
        self::$pm['inbox_title']                   = 'Входяща кутия';
        self::$pm['title']                         = 'Съобщения';
        self::$pm['menu']['inbox']                 = 'Входяща кутия';
        self::$pm['menu']['read']                  = 'Прочетени';
        self::$pm['menu']['unread']                = 'Непрочетени';
        self::$pm['menu']['sent']                  = 'Изпратени';
        self::$pm['delete']                        = 'Изтрий';
        self::$pm['send_title']                    = 'Изпращане на съобщение';

        self::$pm['send_errors']['no_title']       = 'Полето за заглавие е празно';
        self::$pm['send_errors']['no_message']     = 'Полето за съобщение е празно';
        self::$pm['send_errors']['no_reciever']    = 'Не сте избрали получател';
        self::$pm['send_errors']['no_user']        = 'Няма потребител с това потребителско име';
        self::$pm['send_success']                  = 'Изпратихте съобщението';

        self::$pm['send']['error_title']           = 'Грешка при изпращане не съобщението';
        self::$pm['send']['error_message']         = 'Не можете да изпращате съобщение до себе си.';

        self::$options['error']['title']           = 'Грешка при настройване на профила.';
        self::$options['error']['message']         = 'Не сте влезли в системата, а трябва да бъдете, за да настойвате своя акаунт.';

        self::$options['index']['page_title']      = 'Настойки';
        self::$options['changepass']['page_title'] = 'Смяна на паролата';
        self::$options['changeprofile']['title']   = 'Смяна на информацията за профила';
        self::$options['new_avatar']['page_title'] = 'Смяна на аватара';

        self::$options['labels']['l']['password']  = 'Смяна на парола';
        self::$options['labels']['l']['profile']   = 'Смяна на профилна информация';
        self::$options['labels']['l']['avatar']    = 'Смяна на аватар';
        self::$options['labels']['l']['logins']    = 'Последни 5 влизания';

        self::$options['labels']['pw']['old']      = 'Стара парола';
        self::$options['labels']['pw']['new']      = 'Нова парола';
        self::$options['labels']['pw']['re-new']   = 'Отново нова парола';
        self::$options['labels']['pw']['submit']   = 'Смени парола';

        self::$options['labels']['pr']['fname']    = 'Име';
        self::$options['labels']['pr']['lname']    = 'Фамилия';
        self::$options['labels']['pr']['desc']     = 'Описание';
        self::$options['labels']['pr']['submit']   = 'Обнови профила';

        self::$options['labels']['a']['new']       = 'Нов аватар';
        self::$options['labels']['a']['allowed']   = 'Позволени формати са jpg, png и gif с максимална големина на файл от 1 MB и максимална резолюция от 1024x1024.';
        self::$options['labels']['a']['sqare']     = 'Квадрат';
        self::$options['labels']['a']['submit']    = 'Смени аватар';

        self::$options['labels']['ll']['time']     = 'Час';
        self::$options['labels']['ll']['ip']       = 'ИП';

        self::$options['errors']['old_pass']       = 'Старата парола не съвпада с настоящата.';
        self::$options['errors']['pass_too_short'] = 'Новата парола е твърде кратка. Минимумът е 6 знака.';
        self::$options['errors']['pwrds_not_same'] = 'Паролите не съвпадат.';
        self::$options['errors']['pwrds_unknown']  = 'Появи се неизвестен проблем при смяна на Вашата парола. Моля, опитайте отново по-късно или се свържете с притежателя на сайта.';

        self::$options['errors']['cp_fname']       = 'Не можете да сменяте името си, тъй като вече сте го добавили.';
        self::$options['errors']['cp_fname_inv']   = 'Името Ви не е валидно.';
        self::$options['errors']['cp_fname_uld']   = 'Появи се неизвестна грешка, докато добавяхме името към профила Ви. Моля, опитайте отново или се свържете с притежателя на сайта.';
        self::$options['errors']['cp_lname']       = 'Не можете да сменяте фамилията си, тъй като вече сте я добавили.';
        self::$options['errors']['cp_lname_inv']   = 'Фамилията Ви не е валидна.';
        self::$options['errors']['cp_lname_uld']   = 'Появи се неизвестна грешка, докато добавяхме фамилията към профила Ви. Моля, опитайте отново или се свържете с притежателя на сайта.';
        self::$options['errors']['cp_desc_2_long'] = 'Описанието Ви е твърде дълго. Не може да надвишава 400 знака.';
        self::$options['errors']['cp_desc_unk']    = 'Появи се неизвестна грешка, докато добавяхме/променяхме описанието към профила Ви. Моля, опитайте отново или се свържете с притежателя на сайта.';
        self::$options['errors']['image_size']     = 'Аватарът Ви е твърде голям. Не може да надвишава 1 MB.';
        self::$options['errors']['image_format']   = 'Форматът на изображението Ви не се поддържа. Може да е .jpg. .png или .gif.';
        self::$options['errors']['image_save']     = 'Появи се неизвестна грешка при запазване на аватара Ви. Моля, опитайте отново или се свържете с притежателя на сайта.';
        self::$options['errors']['image_part']     = 'Каченият аватар бе само частично качен.';
        self::$options['errors']['no_image']       = 'Не сте качили никакво изображение.';
        self::$options['errors']['unknown']        = 'Появи се неизвестна грешка. Моля, опитайте отново по-късно или се свържете с притежателя на сайта.';

        self::$options['success']['pass']          = 'Паролата Ви бе сменена.';
        self::$options['success']['fname']         = 'Името Ви бе добавено.';
        self::$options['success']['lname']         = 'Фамилията Ви бе добавена.';
        self::$options['success']['desc']          = 'Описанието Ви бе сменено.';

        self::$install['step'][1]                  = 'Конфигурация на базата данни';
        self::$install['step'][2]                  = 'Конфигурация на сайта';
        self::$install['step'][3]                  = 'Администрация';

        self::$install['mysql']['mysql-server']    = 'Би трябвало да може да вземете тази информация от уеб хоста си.';
        self::$install['mysql']['mysql-user']      = 'Потребителското Ви име за базата данни.';
        self::$install['mysql']['mysql-pass']      = 'Паролата за свързване с базата данни.';
        self::$install['mysql']['mysql-db']        = 'Името на базата данни, която искате да използвате. Ако не съществува, ще го създам вместо Вас.';
        self::$install['site']['site-name']        = 'Може да го смените по-късно.';
        self::$install['site']['index-page']       = 'Коя страница да зареди първа, когато някой отваря сайта Ви. По подразбиране: началната страница';
        //self::$install['site']['admin-name']       = 'Your nickname.';
        //self::$install['site']['admin-pass']       = 'Your password.';
        self::$install['site']['path']             = 'Обикновено името на домейна Ви. Важно е за зареждане на изображенията, подаване на формулярите и др.';
        self::$install['site']['timezone']         = 'Часовата зона на сайта трябва да е';
        self::$install['errors'][1]                = 'Изглежда нямате mysqli разширението на PHP. Моля, инсталирайте го и опитайте отново.';
        self::$install['errors'][2]                = 'Грешка. Не може да се свържете с базата данни. Моля, проверете настройките си отново.';
        self::$install['errors'][3]                = 'Грешка. Името на базата данни е невалидно. Трябва да е поне 64 знака и може да съдържа цифри, букви, $ и _';
        self::$install['errors'][4]                = 'Грешка. Не може да запазвате конфигурационен файл.';
        self::$install['errors'][5]                = 'Съжаляваме, но страницата по подразбиране, която заявихте, не може да бъде намерена.';
        self::$install['errors'][6]                = 'Невалиден адрес към сайта. Валиден пример: <b>http://www.yoursite.com/</b>';
        self::$install['errors'][7]                = 'Няма такава часова зона. Може да видите валидните часови зони <a href="http://www.php.net/manual/en/timezones.php">тук</a>';
        self::$install['errors'][8]                = 'Администраторското име е невалидно. Трябва да бъде между 4 и 32 знака.';
        self::$install['errors'][9]                = 'Паролата е твърде кратка.';
        self::$install['errors'][10]               = 'Невалиден пол';
        self::$install['next']                     = 'Следващ';
        self::$install['finish']                   = 'Край';
        self::$install['install_finished_message'] = 'Инсталирахте сайта.';
        self::$install['title']['database']        = 'Инсталация на базата данни';
        self::$install['title']['site']            = 'Конфигурация на сайта';
        self::$install['title']['admin']           = 'Информация за администратор';
        self::$install['title']['success']         = 'Край';
        self::$install['success_message']          = 'Поздравления! Сайтът е конфигуриран правилно. Ако искате да влезете в администраторския панел, отидете в ' . PATH . 'admin/';

        self::$sections['categories']['title']     = 'Категории';
        self::$sections['tags']['title']           = 'Етикети';

        self::$admin['verify']['page_title']       = 'Влизане в администраторския панел';
        self::$admin['verify']['admin_name']       = 'Потребителско име';
        self::$admin['verify']['admin_pass']       = 'Парола';
        self::$admin['verify']['submit']           = 'Вход';
        self::$admin['verify']['error']            = 'Администраторското име или паролата е грешна.';

        self::$admin['labels_header']['article']   = 'Пост';
        self::$admin['labels_header']['category']  = 'Добави категория';
        self::$admin['labels_header']['users']     = 'Потребители';
        self::$admin['labels_header']['settings']  = 'Настройки';

        self::$admin['labels_header']['article_w'] = 'Напиши';
        self::$admin['labels_header']['article_e'] = 'Редактирай';
        self::$admin['labels_header']['users_a']   = 'Добави';
        self::$admin['labels_header']['users_e']   = 'Редактирай';
        self::$admin['labels_header']['appear']    = 'Изглед';

        self::$admin['labels_footer']['users']     = 'Последни потребители';
        self::$admin['labels_footer']['comments']  = 'Последни коментари';

        self::$admin['settings']['l']['title']     = 'Основни настройки';
        self::$admin['settings']['l']['posts']     = 'Публикации на страница';
        self::$admin['settings']['l']['timezone']  = 'Часова зона по подразбиране';
        self::$admin['settings']['l']['control']   = 'Контролер по подразбиране';
        self::$admin['settings']['l']['footer']    = 'Съобщение във футъра';

        self::$admin['settings']['err']['control'] = 'Контролерът не съществува.';
        self::$admin['settings']['err']['pages']   = 'Стойността на публикациите на страница е невалидна.';
        self::$admin['settings']['err']['zone']    = 'Няма такава часова зона. Може да видите валидните часови зони <a href="http://www.php.net/manual/en/timezones.php">тук</a>';

        self::$admin['settings']['l']['save']      = 'Запази';

        self::$admin['article_w_l']['title']       = 'Заглавие';
        self::$admin['article_w_l']['article']     = 'Статия';
        self::$admin['article_w_l']['category']    = 'Категория';
        self::$admin['article_w_l']['tags']        = 'Етикети';
        self::$admin['article_w_l']['tags_hint']   = 'Отделете етикетите с интервал (" ")';
        self::$admin['article_w_l']['edit_coms']   = 'Редактирайте коментарите тук';
        self::$admin['article_w_l']['reset']       = 'Нулиране на брояча';
        self::$admin['article_w_l']['post']        = 'Публикуване';
        self::$admin['article_w_l']['edit']        = 'Редактиране';

        self::$admin['article_w']['title']         = 'Нова статия';
        self::$admin['article_e']['title_ts']      = 'Заглавието е твърде кратко. Минимумът е 4 букви.';
        self::$admin['article_e']['title_tl']      = 'Заглавието е твърде дълго. Максимумът е 55 букви.';
        self::$admin['article_e']['no_cat']        = 'Няма такава категория.';
        self::$admin['article_e']['no_tags']       = 'Няма етикети.';
        self::$admin['article_e']['not_valid']     = 'Заявката не е валидна. Моля, опитайте отново.';
        self::$admin['article_e']['no_perm']       = 'Тази статия не е Ваша. Нямате права да я редактирате.';
        self::$admin['article_e']['success']       = 'Запазихте статията.';

        self::$admin['eal']['title']               = 'Редактиране на статии';
        self::$admin['eal_labels']['title']        = 'Заглавие на статията';
        self::$admin['eal_labels']['edit']         = 'Редактиране';
        self::$admin['eal_labels']['delete']       = 'Изтриване на избраните статии';

        self::$admin['users_edit']['title']        = 'Редактиране на потребителите';
        self::$admin['users_edit']['username']     = 'Потребителско име';
        self::$admin['users_edit']['edit']         = 'Редактиране';
        self::$admin['users_edit']['delete']       = 'Изтриване на избраните потребители';

        self::$admin['user_edit']['user_id']       = 'Потребителско ID';
        self::$admin['user_edit']['username']      = 'Потребителско име';
        self::$admin['user_edit']['email']         = 'Имейл';
        self::$admin['user_edit']['sex']           = 'Пол';
        self::$admin['user_edit']['fname']         = 'Име';
        self::$admin['user_edit']['lname']         = 'Фамилия';
        self::$admin['user_edit']['desc']          = 'Описание';
        self::$admin['user_edit']['permissions']   = 'Права';
        self::$admin['user_edit']['normal']        = 'Нормален';
        self::$admin['user_edit']['moderator']     = 'Модератор';
        self::$admin['user_edit']['rem-avatar']    = 'Премахване на аватара?';
        self::$admin['user_edit']['yes']           = 'Да';
        self::$admin['user_edit']['button']        = 'Редактиране на потребителя';

        self::$admin['ue_errors']['fn_tl']         = 'Името е твърде дълго.';
        self::$admin['ue_errors']['fn_invalid']    = 'Името е невалидно.';
        self::$admin['ue_errors']['ln_tl']         = 'Фамилията е твърде дълга.';
        self::$admin['ue_errors']['ln_invalid']    = 'Фамилията е невалидна.';
        self::$admin['ue_errors']['desc']          = 'Описанието е твърде дълго. Максимумът е 400 знака.';
        self::$admin['ue_errors']['unknown']       = 'Появи се неизвестна грешка.Моля, опитайте отново!';
        self::$admin['ue_errors']['success']       = 'Потребителският профил бе редактиран.';

        self::$admin['user_add']['title']          = 'Добавяне на потребител';
        self::$admin['user_add']['permissions']    = 'Права';
        self::$admin['user_add']['moderator']      = 'Модератор';
        self::$admin['user_add']['normal']         = 'Нормален';
        self::$admin['user_add']['add']            = 'Добавяне на потребител';
        self::$admin['user_add']['success']        = 'Успешно добавихте потребител.';

        self::$admin['feedback']['title']          = 'Обратна връзка';
        self::$admin['feedback']['from']           = 'От: ';
        self::$admin['feedback']['email']          = 'Имейл: ';

        self::$admin['add_category']['no_cats']    = 'Няма категории. Направете няколко <a href="'. PATH . 'admin/add_category/">тук</a>';
        self::$admin['add_category']['title']      = 'Добавяне на категория';
        self::$admin['add_category']['l']['name']  = 'Име на категорията';
        self::$admin['add_category']['l']['add']   = 'Добавяне на категория';
        self::$admin['add_category']['success']    = 'Добавихте категорията';
        self::$admin['errors']['unknown']          = 'Вече може да сте добавили категорията. Моля, проверете и опитайте отново.';
        self::$admin['errors']['too_long']         = 'Името на категорията не може да липсва или да е по-дълго от 32 знака.';
        self::$admin['errors']['cat_exists']       = 'Тази категория вече съществува.';

        self::$admin['appearance']['title']        = 'Изглед';
    }

}