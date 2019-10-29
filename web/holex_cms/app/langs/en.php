<?php

if (!defined("_VALID_PHP")) {die();}

return [
	// common

	'az' => 'Azerbaijani',
	'en' => 'English',
	'ru' => 'Russian',

	'access' => 'Access',
	'access_granted' => 'Granted',
	'access_prohibited' => 'Prohibited',
	'add' => 'Add',
	'alert' => 'Warning!',
	'alert_success' => 'Great!',
	'alert_warning' => 'Warning!',
	'alert_info' => 'Tip!',
	'alert_danger' => 'D`oh!',
	'apply' => 'Apply',
	'author' => 'Author',
	'back' => 'Back',
	'cancel' => 'Cancel',
	'common_data' => 'Common info',
	'content' => 'Content',
	'controls' => 'Controls',
	'del_suc' => 'Successfully deleted',
	'del_err' => 'Unable to delete',
	'delete' => 'Delete',
	'delete_confirmation' => 'Are you sure you want to delete this post?',
	'delete_confirmation_user' => 'Are you sure you want to delete this user?',
	'edit' => 'Edit',
	'editor' => 'Editor',
	'filter' => 'Filter',
	'filter_all' => 'All',
	'filter_popup_title' => 'Additional parameters',
	'filter_no_matter' => 'No matter',
	'get_err' => 'Invalid request',
	'greetings' => 'Hi, ',
	'greetings_content' => 'Welcome to PROFIT CMS.<br /><br />Choose menu item.',
    'helloAdmin' => 'Hello',
	'image' => 'Image',
	'insert_err' => 'Unable to add data',
	'insert_suc' => 'Successfully added',
	'logout' => 'Sign out',
	'lookAtSite' => 'Look at Site',
	'main_page' => 'Main page',
	'more_info' => 'More info',
	'no_data_found' => 'No data found',
	'pg' => 'paginated',
	'pg_all' => 'show all',
	'pg_2end' => 'to the end',
	'pg_2start' => 'to the beginning',
	'pg_next' => 'next',
	'pg_prev' => 'previous',
	'publish' => 'Publish',
	'publish_lang' => 'publish on this language',
	'publish_off' => 'Not published',
	'publish_on' => 'Published',
	'reset' => 'Reset',
	'resourses' => 'Resourses',
	'save' => 'Save',
	'search' => 'Search',
	'search_query' => 'search query',
	'show_site' => 'Show Site',
	'status' => 'Status',
	'toggle_navigation' => 'Toggle navigation',
	'update_err' => 'Update error',
	'update_no_data_affected' => 'No data affected',
	'update_suc' => 'Data successfully saved',
	'view' => 'Preview',

	// Password Generator

	'password_generator' => 'Password Generator',
	'password_generator_approve' => 'I have copied this password in a safe place.',
	'password_generator_btn_cancel' => 'Cancel',
	'password_generator_btn_regenerate' => 'Generate again',
	'password_generator_btn_use' => 'Use password',

	// javascript

	'js_alert' => 'Notification',
	'js_confirmation' => 'Confirmation',
	'js_cancel' => 'Cancel',
	'js_ok' => 'OK',
	'js_close' => 'Close',
	'js_confirm' => 'Confirm',

	// File Upload

	'upl_invalid_image_extension_err' => 'Only files with *.jpg, *.png extensions can be uploaded',
	'upl_ini_size_err' => 'Total uploading data size over server limitation',
	'upl_form_size_err' => 'The file is too big',
	'upl_partial_err' => 'Upload interrupted. Try again.',
	'upl_no_file_err' => 'No file chosen',
	'upl_no_tmp_dir_err' => 'No tmp directory on the server',
	'upl_can_write_err' => 'No writing permissions',
	'upl_extension_err' => 'Invalis file extension',
	'browse_placeholder' => 'Choose file',
	'browse_button_text' => 'Browse',

	// Notification E-mails & messages

	'password_recovery_subj' => 'Pasword recovery',
	'password_recovery_msg' => '<h1>Hi {username}</h1><p>Use this link to change your password <a href="{recovery_link}">{recovery_link}</a></p>',

	// CMS - Log in

	'login_title' => 'Sign in',
	'login_form_tip' => 'Sign in',
	'login_email_placeholder' => 'E-mail',
	'login_password_placeholder' => 'Password',
	'login_password_recovery' => 'Password recovery',
	'login_remember_me' => 'Remember me',
	'login_sign_in' => 'Sign in',
	'login_social_facebook' => 'Facebook',
	'login_social_googleplus' => 'Google+',
	'login_err' => 'Invalid E-mail or password',
	'login_err_blocked' => 'This profile is plocked',
	'login_social_err' => 'There is no profile registered for this user ({usermail}, {username})',
	'login_suc' => 'Welcome',

	// CMS - Password recovery

	'password_recovery_title' => 'Password recovery',
	'password_recovery_email_placeholder' => 'E-mail',
	'password_recovery_form_tip' => 'Enter your E-mail and we will send password recovery link',
	'password_recovery_login' => 'or try to sign in as a different user',
	'password_recovery_err_email_invalid' => 'Invalid E-mail',
	'password_recovery_err_email_cannot_send' => 'Cannot send E-mail',
	'password_recovery_err_user_not_found' => 'User not found',
	'password_recovery_suc_email_sended' => 'E-mail successfully sent to {email}. Check your Inbox and Junk folders.',

	// CMS - Password change

	'password_change_title' => 'Change password',
	'password_change_placeholder' => 'New password',
	'password_change_err_account_hash_expired' => 'Link expired',
	'password_change_suc' => 'Password successfully changed',

	// CMS - Action approve (screenlock)

	'password_approve_title' => 'Approve your account',
	'password_approve_placeholder' => 'Password',
	'password_approve_descr' => 'You try to perform insecure action. We need to verify your account. Please, enter your password to continue.',

	// 403

	'403_title' => '403',
	'403_headline' => 'Forbidden',
	'403_descr' => 'Access denied. Return to administrators (developers) or <a href="?controller=base&amp;action=sign_out">change user</a>.',

	// 404

	'404_title' => '404',
	'404_headline' => 'Oops! Page not found.',
	'404_descr' => 'We could not find the page you were looking for :( <!-- Meanwhile, you may <a href="{dashboard_link}">return to dashboard</a> or try using the search form. -->',

	// CMS menu blocks and items

	'menu_title' => 'Menu',
	'menu_block_dashboard' => 'Dashboard',
	'menu_item_statistics_dashboard' => 'Overview',
	'menu_block_site_users' => 'Moderation',
	'menu_item_site_users_list' => 'Site users',
	'menu_item_site_users_view_info' => 'View info',
	'menu_item_comments_list' => 'Comments',
	'menu_item_comments_edit' => 'Edit comment',
	'menu_block_cms_users' => 'CMS users',
	'menu_item_cms_users_list' => 'CMS users',
	'menu_item_cms_users_add' => 'Add user',
	'menu_item_cms_users_edit' => 'Edit user',
	'menu_block_content' => 'Content',
	'menu_block_nav' => 'Navigation',
	'menu_item_articles_list' => 'Articles',
	'menu_item_articles_add' => 'Add article',
	'menu_item_articles_edit' => 'Edit article',
	'menu_item_gallery_list' => 'Galleries',
	'menu_item_gallery_add' => 'Add gallery',
	'menu_item_gallery_edit' => 'Edit gallery',
	'menu_item_gallery_photos' => 'Photos',
	'menu_item_gallery_add_photo' => 'Add photos to gallery',
	'menu_item_gallery_edit_photo' => 'Edit gallery photo',
	'menu_item_complaints' => 'Feedback',
	'menu_item_edit_admin_user_cats' => 'User allowed categories',
	'menu_item_edit_admin_user_privilegies' => 'User permissions',
	'menu_block_settings' => 'Site settings',
	'menu_item_site_languages' => 'Language versions',
	'menu_item_edit_lang' => 'Edit translations',

	// Dashboard

	'dashboard_latest_members' => 'Latest members',
	'dashboard_new_members' => '{n} new user',
	'dashboard_view_all_users' => 'View all users',
	'dashboard_articles_posted' => 'articles posted',
	'dashboard_cms_users_count' => 'CMS users',

	// CMS users

	'add_cms_user' => 'Add CMS user',
	'cms_user_empty_login_err' => 'E-mail is required',
	'cms_user_edit_login_invalid_err' => 'Invalid E-mail',
	'cms_user_duplicate_login_err' => 'User already exists',
	'cms_user_lang' => 'Interface language',
	'cms_user_lang_placeholder' => 'Choose language',
	'cms_user_lang_err' => 'Invalid language',
	'cms_user_login' => 'E-mail',
	'cms_user_name' => 'Name',
	'cms_user_name_err' => 'Username is invalid',
	'cms_user_new_pwd' => 'New password. Leave empty to preserve the same.',
	'cms_user_not_found' => 'User not found',
	'cms_user_avatar' => 'Userpic',
	'cms_user_pwd' => 'Password',
	'cms_user_pwd_generate' => 'Generate',
	'cms_user_pwd_approve' => 'Enter your own password',
	'cms_user_pwd_approve_err' => 'Password is invalid. %d attempts remain.',
	'cms_user_pwd_approve_self' => 'Old password',
	'cms_user_pwd_repeat' => 'Repeat password',
	'cms_user_pwd_err' => 'Entered password is invalid. Use 6-64 digits, letters or punctuation signs.',
	'cms_user_pwd_not_equal_err' => 'Passwords did not match',
	'cms_user_reg_date' => 'Registration date',
	'cms_user_role' => 'Role',
	'cms_users_role_admin' => 'Administrator',
	'cms_users_role_editor' => 'Editor',
	'cms_user_role_placeholder' => 'Choose role',
	'cms_user_role_err' => 'Invalid role',
	'cms_user_edit_err_not_found' => 'User not found',
	'cms_user_edit_approvable_data_lost_err' => 'Approvable data lost',
	'cms_user_is_online' => 'Online',
	'cms_users_list' => 'Users list',
	'cms_users_list_details' => '{count} users found',
	'cms_users_search' => 'Search',
	//'cms_users_top_menu_item' => 'Administration',
	'edit_cms_user' => 'Edit user',
	'edit_cms_user_self' => 'My profile',
	'cms_users_menu_section_allow' => 'Allow content editing in this category',

	// Photo Gallery

	'gallery' => 'Gallery',
	'gallery_list_details' => '{count} galleries found',
	'gallery_album_add' => 'Add gallery folder',
	'gallery_album_add_datetime' => 'Added',
	'gallery_album_edit' => 'Edit gallery folder',
	'gallery_album_name' => 'Gallery name',
	'gallery_albums_list' => 'Galleries list',
	'gallery_name_empty' => 'Gallery name cannot be empty',
	'gallery_not_found_err' => 'Gallery not found',
	'gallery_photo' => 'Photo',
	'gallery_photo_add' => 'add',
	'gallery_photo_add_quantity_err' => 'max 20 photos',
	'gallery_photo_edit' => 'Edit photo',
	'gallery_photo_name' => 'Photo name',
	'gallery_photo_subtext' => 'Photo description',
	'gallery_photos_add' => 'Add photos',
	'gallery_photos_list' => 'Photos',
	'gallery_photos_list_details' => '{count} photos found',
	'gallery_photos_num' => 'Photos count',
	'gallery_edit_err_name_empty' => 'Gallery name cannot be empty',

	// languages - SITE languages

	'site_lang_code' => 'ISO 639-1',
	'site_lang_name' => 'Language native name',
	'site_lang_published' => 'Published',
	'site_lang_add_popup_title' => 'New language version',
	'site_lang_add_popup_descr' => 'After adding new language version you will be able to translate phrases. <strong>DO NOT PUBLISH</strong> language version until you are sure that translation is finished and navigation is translated too. Remember also that if article have no translation 404 error page will be shown.',
	'site_lang_add_err_invalid_code' => 'ISO 639-1 code is invalid',
	'site_lang_add_err_duplicate_code' => 'ISO 639-1 code already used',
	'site_lang_add_err_invalid_name' => 'Native name required',
	'site_lang_tr_key' => 'Key',
	'site_lang_tr_value' => 'Value',
	'site_lang_tr_value_not_translated' => 'Not translated',

	// Content - Articles

	'article_category' => 'Category',
	'article_category_none' => 'No category',
	'article_sef' => 'SEF',
	'article_sef_descr' => 'Type any phrase and valid SEF string will be generated automatically.',
	'article_source' => 'Source',
	'article_source_url' => 'Source URL',
	'article_source_name' => 'Source Name',
	'article_image_descr' => '{types} extensions allowed.',
	'article_image_original_view' => 'Original',
	'article_image_original_size' => 'Original size',
	'article_image_original_upload_datetime' => 'Uploaded',
	'article_image_thumbnail_size' => 'Thumbnail size',
	'articles_list_details' => '{count} articles found',
	'article_publish_datetime' => 'Publish datetime',
	'article_publish_date_placeholder' => 'Date',
	'article_publish_hour_placeholder' => 'Hours',
	'article_publish_minutes_placeholder' => 'Minutes',
	'article_gallery' => 'Gallery',
	'article_author' => 'Creator',
	'article_title' => 'Title',
	'article_keywords' => 'Keywords',
	'article_short' => 'Short text',
	'article_full' => 'Full text',
	'article_show_on_main_page' => 'Show on main page',
	'article_show_on_main_page_filter' => 'Shown on main page',
	'article_show_off_main_page_filter' => 'Not shown on main page',
	'article_is_highlighted' => 'Highlighted',
	'article_is_highlighted_filter' => 'Highlighted',
	'article_add_err_title_empty' => 'Title cannot be empty',
	'article_add_err_full_empty' => 'Article text cannot be empty',
	'article_add_err_publish_date_invalid' => 'Publishing date is invalid',
	'article_add_err_publish_hour_invalid' => 'Publishing hour is invalid',
	'article_add_err_publish_minutes_invalid' => 'Publishing minutes is invalid',
	'article_add_err_gallery_not_exists' => 'Gallery not exists',
	'article_add_err_source_url_invalid' => 'Sourse URL is invalid',
	'article_edit_err_not_found' => 'Article not found',
	'article_edit_err_sef_empty' => 'Article SEF cannot be empty',
	'articles_assignment' => 'Additional assignment',

	// Navigation

	'nav_menu' => 'Menu',
	'nav_menu_structure' => 'Tree view',
	'nav_menu_add_item' => 'Add sub item',
	'nav_menu_del_item' => 'Delete sub item',
	'nav_menu_edit_item' => 'Preview / Edit item',
	'nav_menu_item_name' => 'Name',
	'nav_menu_item_type' => 'Type',
	'nav_menu_item_type_article' => 'Article',
	'nav_menu_item_type_category' => 'Category',
	'nav_menu_item_type_spec' => 'Special page',
	'nav_menu_item_type_url' => 'Link',
	'nav_menu_item_sef' => 'SEF (unique)',
	'nav_menu_item_ref_article' => 'Choose article (autocomplete after 2 char)',
	'nav_menu_item_url' => 'URL',
	'nav_menu_item_url_descr' => 'If this element is nesting for others and have no own link, leave &quot;#&quot;.<br />
	Local URLs must begin with &quot;/&quot;.<br />
	All other link will be assumed as global URLs and remain unchanged.<br />
	You can also use wildcard {lang} for dinamic language definition.',
	'nav_menu_item_position' => 'Position',
	'nav_menu_item_is_section' => 'Is section (category or special page with linked content and assignable for editor)',
	'nav_menu_add_item_err_type_invalid' => 'Type is invalid',
	'nav_menu_add_item_err_sef_invalid' => 'SEF is invalid',
	'nav_menu_add_item_err_sef_exists' => 'SEF already exists',
	'nav_menu_add_item_err_article_id_empty' => 'Article is empty',
	'nav_menu_add_item_err_article_id_not_exists' => 'Article not found',
	'nav_menu_add_item_err_article_id_item_exists' => 'Article already used in other menu item',
	'nav_menu_add_item_err_name_empty' => 'Name cannot be empty',
	'nav_menu_add_item_err_position_empty' => 'No position chosen',
	'nav_menu_edit_item_err_not_found' => 'Item not found',
	'nav_menu_level_up' => 'Up',

	// Moderation - Site users

	'site_users_list_details' => '{count} users found',
	'site_users_has_registered' => 'users has registered',
	'site_user_profile_info' => 'Profile',
	'site_user_email' => 'E-mail',
	'site_user_name' => 'Name, Surname',
	'site_user_reg_date' => 'Registration date',
	'site_user_reg_date_since' => 'since',
	'site_user_reg_date_till' => 'till',
	'site_users_provider' => 'Provider',
	'site_users_provider_none' => 'Free user',
	'site_user_nickname' => 'Nick',
	'site_user_birth_date' => 'Birth date',
	'site_user_gender' => 'Gender',
	'site_user_gender_male' => 'Male',
	'site_user_gender_female' => 'Female',
	'site_user_registration_datetime' => 'Registration datetime',
	'site_user_last_login_datetime' => 'Last login datetime',
	'site_user_comments_count' => 'Comments count',

	// Moderation - Comments

	'comments_list_details' => '{count} comments found',
	'comments_are_left' => 'comments are left',
	'comments_user' => 'User',
	'comments_preambula' => 'Preambula',
	'comment_text' => 'Text',
	'comments_posted_datetime' => 'Posted datetime',
	'comments_posted_datetime_since' => 'since',
	'comments_posted_datetime_till' => 'till',
	'comments_is_published' => 'Published',
	'comments_is_inspected' => 'Inspected',
	'comment_inspected' => 'Inspected',
	'comment_not_inspected' => 'Not inspected',
	'comments_moderate' => 'Moderation',
	'comments_moderate_allow' => 'Allow',
	'comments_moderate_deny' => 'Deny',

	// Moderation - Feedback

	'complaints_chat_list' => 'Chats',
	'complaints_username' => 'Username',
	'complaints_last_msg_date' => 'Last message date',
	'complaints_last_msg_short' => 'Last message quot',
    'complaints_answeredness' => 'Answered',
    'complaints_answeredness_all' => 'All',
    'complaints_answeredness_not' => 'Not answered',
    'complaints_answeredness_yep' => 'Answered',
	'complaints_answer_notification_sms' => 'Your complain was reviewed',
	'complaints_answer_notification_subj' => 'Your complain was reviewed',
	'complaints_answer_notification_email' => '<h1 style="font-size: medium; font-family: serif; font-weight: normal;">Dear {username},</h1><p style="font-size: medium; font-family: serif; font-weight: normal;">Your complain was reviewed:</p><blockquote> {answer} </blockquote><p style="font-size: medium; font-family: serif; font-weight: normal;">Complain text:</p><blockquote> {complaint} </blockquote>',
    'complaints_message_err' => 'Message cannot be empty',
    'complaints_file_err' => 'Invalid file format',
	'complaints_chat_with' => 'Chat with {username}',
	'complaints_answered' => 'Complaint answered',
	'complaints_give_answer' => 'Give answer',

];

?>