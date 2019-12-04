<?php

if (!defined("_VALID_PHP")) {die('Access denied');}

return [
	// common

	'az' => 'Azərbaycan',
	'en' => 'İnqilis',
	'ru' => 'Rus',

	'access' => 'Daxil olmağının icazəsi',
	'access_granted' => 'İcazə verilib',
	'access_prohibited' => 'Qadağan olunub',
	'add' => 'Əlavə et',
	'alert' => 'Diqqət!',
	'alert_success' => 'Əla!',
	'alert_warning' => 'Diqqət!',
	'alert_info' => 'Qeyd!',
	'alert_danger' => 'Səhv!',
	'apply' => 'Tətbiq et',
	'author' => 'Müəllif',
	'back' => 'Geriyə',
	'cancel' => 'İmtina et',
	'common_data' => 'Ümumi məlumat',
	'content' => 'Kontent',
	'controls' => 'İdarə edilməsi',
	'del_suc' => 'Müvəffəqiyyətlə silindi',
	'del_err' => 'Silmək mümkün olmadı',
	'delete' => 'Sil',
	'delete_confirmation' => 'Bunu silmək istədiyinizə əminsinizmi?',
	'delete_confirmation_user' => 'Bunu silmək istədiyinizə əminsinizmi?',
	'edit' => 'Redaktə et',
	'editor' => 'Redaktor',
	'filter' => 'Filtr',
	'filter_all' => 'Hamısı',
	'filter_popup_title' => 'Əlavə parametrləri seçin',
	'filter_no_matter' => 'Vacib deyil',
	'get_err' => 'Səhifə mövcüd deyil',
	'greetings' => 'Salam ',
	'greetings_content' => 'PROFIT CMS-ə xoş gəldiniz.<br /><br />Bölməni seçin.',
    'helloAdmin' => 'Salam',
	'image' => 'Şəkil',
	'insert_err' => 'Əlavə etmək mümkün deyil',
	'insert_suc' => 'Müvəffəqiyyətlə əlavə olundu',
	'logout' => 'Çıxış',
	'lookAtSite' => 'Sayta bax',
	'main_page' => 'Əsas səhifə',
	'more_info' => 'Əlavə məlumat',
	'no_data_found' => 'Məlumat tapılmayıb',
	'pg' => 'səhifələrlə göstər',
	'pg_all' => 'hamısını göstər',
	'pg_2end' => 'sonuncu',
	'pg_2start' => 'birinci',
	'pg_next' => 'növbəti',
	'pg_prev' => 'əvvəlki',
	'publish' => 'Dərc et',
	'publish_lang' => 'bu dilində dərc et',
	'publish_off' => 'Dərc edilməyib',
	'publish_on' => 'Dərc edilib',
	'reset' => 'Dəyişiklikləri ləğv et',
	'resourses' => 'Resurslar',
	'save' => 'Yadda saxla',
	'search' => 'Axtar',
	'search_query' => 'sorğunuzu daxil edin',
	'show_site' => 'Saytın görünüşü',
	'status' => 'Dərc edilməsi',
	'toggle_navigation' => 'Menyunu gizlət/göstər',
	'update_err' => 'Dəyişiklikləri saxlamaq mümkün deyil',
	'update_no_data_affected' => 'Dəyişikliklər olmayıb',
	'update_suc' => 'Dəyişikliklər müvəffəqiyyətlə yerinə yetirildi',
	'view' => 'Baxış',
    'multi_image_select_warn' => 'bir yükləmədə 5-dən artıq şəkil olmamalıdır',

	// Password Generator

	'password_generator' => 'Şifrənin avtomatik yaradılması',
	'password_generator_approve' => 'Mən bu şifəni daimi yerə köçürdüm.',
	'password_generator_btn_cancel' => 'İmtina et',
	'password_generator_btn_regenerate' => 'Yenidən yarat',
	'password_generator_btn_use' => 'İstifadə et',

	// javascript

	'js_alert' => 'Xəbərdarlıq',
	'js_confirmation' => 'Əməliyyatınızı təsdiq edin',
	'js_close' => 'Bağla',
	'js_ok' => 'OK',
	'js_cancel' => 'İmtina et',
	'js_confirm' => 'Təsdiq et',

	// File Upload

	'upl_invalid_image_extension_err' => 'Ancaq *.jpg, *.png formatlı faylların yüklənməsinə icazə verilir',
	'upl_ini_size_err' => 'Ümumi POST və faylların çəkisi server məhdudiyyəti ötüb',
	'upl_form_size_err' => 'Şəklin məqbul ölçüsü (çəkisi) ötüb',
	'upl_partial_err' => 'Faylın ötürülməsi dayandırıldı, bir daha cəhd edin',
	'upl_no_file_err' => 'Fayl seçilməyib',
	'upl_no_tmp_dir_err' => 'Fayl serverdə mövcud olan problemlərə görə yüklənmədi',
	'upl_can_write_err' => 'Fayl serverdə mövcud olan problemlərə görə yüklənmədi',
	'upl_extension_err' => 'Fayl serverdə mövcud olan problemlərə görə yüklənmədi',
	'browse_placeholder' => 'Fayl seçilməyib',
	'browse_button_text' => 'Faylı seç',

	// Notification E-mails & messages

	'password_recovery_subj' => 'Şifrənin bərpası',
	'password_recovery_msg' => '<h1>Salam, {username}</h1><p>Şifrəni dəyişmək üçün bu linkə keçid edin <a href="{recovery_link}">{recovery_link}</a></p>',

	// CMS - Log in

	'login_title' => 'Giriş səhifəsi',
	'login_form_tip' => 'Seansı başlamaq üçün daxil olun',
	'login_email_placeholder' => 'E-poçt',
	'login_password_placeholder' => 'Şifrə',
	'login_password_recovery' => 'Şifrəni unutdum',
	'login_remember_me' => 'Sistemdən çıxma',
	'login_sign_in' => 'Daxil ol',
	'login_social_facebook' => 'Facebook vasitəsi ilə daxil ol',
	'login_social_googleplus' => 'Google+ vasitəsi ilə daxil ol',
	'login_err' => 'Elektron ünvan və ya şifrə səhvdir',
	'login_err_blocked' => 'Giriş gadağandır',
	'login_social_err' => 'Seçilmiş istifadəçi ({usermail}, {username}) üçün şəxsi kabineti yaratmayıb',
	'login_suc' => 'Xoş gəlmişsiniz!',

	// CMS - Password recovery

	'password_recovery_title' => 'Şifrənin bərpa edilməsi',
	'password_recovery_email_placeholder' => 'E-poçt',
	'password_recovery_form_tip' => 'Öz E-poçt ünvanınızı daxil edin, göstərilən ünvana şifrəni dəyişmək üçün məktub göndəriləcək.',
	'password_recovery_login' => 'Və ya digər istifadəçi kimi daxil olun',
	'password_recovery_err_email_invalid' => 'E-mail ünvanı yanlışdır',
	'password_recovery_err_email_cannot_send' => 'Məktub göndərmək mümkün deyil',
	'password_recovery_err_user_not_found' => 'İstifadəçi tapılmayıb',
	'password_recovery_suc_email_sended' => 'Müvəffəqiyyətlə göndərilib',

	// CMS - Password change

	'password_change_title' => 'Şifrənin dəyişdirilməsi',
	'password_change_placeholder' => 'Yeni şifrəni daxil edin',
	'password_change_err_account_hash_expired' => 'Linkiniz köhnəlib',
	'password_change_suc' => 'Dəyişikliklər müvəffəqiyyətlə yerinə yetirildi',

	// CMS - Action approve (screenlock)

	'password_approve_title' => 'Təhlükəsizlik yoxlaması',
	'password_approve_placeholder' => 'Şifrə',
	'password_approve_descr' => 'Davam etmək üçün öz şifrənizi daxil edin.',

	// 403

	'403_title' => '403',
	'403_headline' => 'Bu sahifəyə icazə yoxdur',
	'403_descr' => 'Bu səhifənin baxılmasına icazə yoxdur. Administratora müracıət edin.',

	// 404

	'404_title' => '404',
	'404_headline' => 'Sahifə tapılmayıb.',
	'404_descr' => 'Axtardığınız səhifə tapılmadı.',

	// CMS menu blocks and items

	'menu_title' => 'Menyu',
	'menu_block_dashboard' => 'Göstəricilər',
	'menu_item_statistics_dashboard' => 'Göstəricilər',
	'menu_block_site_users' => 'Moderasiya',
	'menu_item_site_users_list' => 'İstifadəçilər',
	'menu_item_site_users_view_info' => 'İstifadəçi haqqında məlumat',
	'menu_item_comments_list' => 'Şərhlər',
	'menu_item_comments_edit' => 'Şərhin moderasiyası',
	'menu_block_cms_users' => 'CMS istifadəçilər',
	'menu_item_cms_users_list' => 'İstifadəçilərin siyahısı',
	'menu_item_cms_users_add' => 'İstifadəçini əlavə et',
	'menu_item_cms_users_edit' => 'İstifadəçini redaktə et',
	'menu_block_content' => 'Kontent',
	'menu_block_nav' => 'Naviqasiya',
	'menu_item_articles_list' => 'Məqalələr',
	'menu_item_articles_add' => 'Məqaləni əlavə et',
	'menu_item_articles_edit' => 'Məqaləni redaktə et',
	'menu_item_complaints' => 'Əks əlaqə',
	'menu_item_edit_admin_user_cats' => 'İstifadəçinin nəzarətində olan bölmələr',
	'menu_item_edit_admin_user_privilegies' => 'İstifadəçinin səlahiyyətləri',
	'menu_block_settings' => 'Saytın sazlanmaları',
	'menu_item_site_languages' => 'Dil versiyaları',
	'menu_item_edit_lang' => 'Dili redaktə et',

	// Dashboard

	'dashboard_latest_members' => 'Son istifadəçilər',
	'dashboard_new_members' => '{n} yeni istifadçilər',
	'dashboard_view_all_users' => 'Bütün istifadəçilər',
	'dashboard_articles_posted' => 'məqalə əlavə edilib',
	'dashboard_cms_users_count' => 'CMS istifadəçi',

	// CMS users

	'add_cms_user' => 'İstifadəçini əlavə et',
	'cms_user_empty_login_err' => 'Login xanasını doldurun',
	'cms_user_edit_login_invalid_err' => 'Login yanlışdır',
	'cms_user_duplicate_login_err' => 'Bu login sistemdə artıq qeyd edilmişdir',
	'cms_user_lang' => 'İnterfeys dilini',
	'cms_user_lang_placeholder' => 'Dili seçin',
	'cms_user_lang_err' => 'Daxil etdiyiniz dil sistemdə tapılmayıb',
	'cms_user_login' => 'Elektron poçt ünvanı (login kimi istifadə olunacaq)',
	'cms_user_name' => 'İstifadəçinin adı',
	'cms_user_name_err' => 'İstifadəçinin adı yanlışdır',
	'cms_user_new_pwd' => 'Yeni şifrə. Dəyişmək istəmirsinizsə, bu xanalara dəyməyin.',
	'cms_user_not_found' => 'İstifadəçi tapılmayıb',
	'cms_user_avatar' => 'Avatar',
	'cms_user_pwd' => 'Şifrə',
	'cms_user_pwd_generate' => 'Yarat',
	'cms_user_pwd_approve' => 'Təhlükəsizlik məqsədi ilə öz şifrənizi daxil edin',
	'cms_user_pwd_approve_err' => 'Şifrəniz yanlışdır. %d cəhtiniz qalıb.',
	'cms_user_pwd_approve_self' => 'Köhnə şifrəniz',
	'cms_user_pwd_repeat' => 'Şifrə təsdiqlə',
	'cms_user_pwd_err' => 'Daxil etdiyiniz şifrədə qadağan olunmuş simvollardan istifadə edilmişdir və ya uzunluğu uyğun deyil. Şifrə 6 - 64-ə qədər  rəqəmlərdən (0-9), durğu işarələrindən və hərflərdən (a-z) ibarət ola bilər.',
	'cms_user_pwd_not_equal_err' => 'Daxil etdiyiniz şifrələr üst-üstə düşmür.',
	'cms_user_reg_date' => 'Qeydiyyat tarixi',
	'cms_user_role' => 'Rol',
	'cms_users_role_admin' => 'Admin',
	'cms_users_role_editor' => 'Redaktor',
	'cms_user_role_placeholder' => 'Rolu seçin',
	'cms_user_role_err' => 'Rol yanlışdır',
	'cms_user_edit_err_not_found' => 'İstifadəçi tapılmayıb',
	'cms_user_edit_approvable_data_lost_err' => 'Vay, deyəsən məlumatlar itirilib :(',
	'cms_user_is_online' => 'Onlayn',
	'cms_users_list' => 'İstifadəçilərin siyahısı',
	'cms_users_list_details' => '{count} istifadəçi tapılıb',
	'cms_users_search' => 'İstifadəçilərin axtarışı',
	//'cms_users_top_menu_item' => 'İdərə edən istifadəçilər',
	'edit_cms_user' => 'İstifadəçi məlumatın düzəlişi',
	'edit_cms_user_self' => 'Mənim profilim',
	'cms_users_menu_section_allow' => 'Bu bölmədə kontentin əlavə və redaktə edilməsinə icazə ver',

	// Photo Gallery

	'gallery' => 'Qalereya',
	'gallery_list_details' => '{count} qalereya tapılıb',
	'gallery_album_add' => 'Albom əlavə et',
	'gallery_album_add_datetime' => 'Əlavə olunduğu tarix',
	'gallery_album_edit' => 'Albomu redaktə et',
	'gallery_album_name' => 'Albomun adı',
	'gallery_albums_list' => 'Albomların siyahısı',
	'gallery_name_empty' => 'Qalereyanın adı boş ola bilməz',
	'gallery_not_found_err' => 'Şəkillərin yüklənməsi üçün qalereya tapılmadı',
	'gallery_photo' => 'Şəkil',
	'gallery_photo_add' => 'Şəkil əlavə et',
	'gallery_photo_add_quantity_err' => '20-dən artıq şəkil bir dəfəyə yükləmək olmaz',
	'gallery_photo_edit' => 'Şəkli redaktə et',
	'gallery_photo_name' => 'Şəklin adı',
	'gallery_photo_subtext' => 'Şəklin alt yazı',
	'gallery_photos_add' => 'Şəkillər əlavə et',
	'gallery_photos_list' => 'Şəkillərin siyahısı',
	'gallery_photos_list_details' => '{count} şəkil tapılıb',
	'gallery_photos_num' => 'Şəkillərin sayı',
	'gallery_edit_err_name_empty' => 'Albomun adı boş ola bilməz',

	// languages - SITE languages

	'site_lang_code' => 'ISO 639-1',
	'site_lang_name' => 'Dilin adı',
	'site_lang_published' => 'Dərc edilməsi',
	'site_lang_add_popup_title' => 'Sayta yeni dilin əlavə olunması',
	'site_lang_add_popup_descr' => 'Yeni dili əlavə etdikdən sonra ifadə və bildirişləri tərcümə edə biləcəksiniz. Menyu, ifadə və bildirişlərin tərcümələri olmadığı halda dilin dərc edilməsi <strong>məsləhət görülmür</strong>. Eləcədə nəzərə almaq lazımdır ki, məqalənin hər hansı bir dildə tərcüməsi olmadığı halda həmin dildə baxışı mümkün olan deyil.',
	'site_lang_add_err_invalid_code' => 'ISO 639-1 kodu yanlışdır',
	'site_lang_add_err_duplicate_code' => 'Daxil etdiyiniz ISO 639-1 kodu artıq əlavə edilib',
	'site_lang_add_err_invalid_name' => 'Dilin adı boş ola bilməz',
	'site_lang_tr_key' => 'Açar',
	'site_lang_tr_value' => 'Tərcümə',
	'site_lang_tr_value_not_translated' => 'Tərcümə olunmayıb',

	// Content - Articles

	'article_category' => 'Kateqoriya',
	'article_category_none' => 'Kateqoriyasız',
	'article_sef' => 'İnsana aydın olan URL (SEF URL)',
	'article_sef_descr' => 'Məqalə başlığının ingilis dilində tərcüməsi daxil etməyiniz məsləhət görülür.<br />Həmin cümlə URL-ın yaradılmasında avtomatik olaraq istifadə olunacaq.',
	'article_source' => 'Original məqalənin mənbəsi',
	'article_source_url' => 'URL',
	'article_source_name' => 'Mənbənin adı',
	'article_image_descr' => '{types} formatlı faylların yüklənməsinə icazə verilir.',
	'article_image_original_view' => 'Orijinal',
	'article_image_original_size' => 'Orijinal şəklin həcmi',
	'article_image_original_upload_datetime' => 'Serverə yüklənib',
	'article_image_thumbnail_size' => 'Eskiz şəklin həcmi',
	'articles_list_details' => '{count} məqalə tapılıb',
	'article_publish_datetime' => 'Məqalənin dərc olunma tarixi və vaxtı',
	'article_publish_date_placeholder' => 'Tarix',
	'article_publish_hour_placeholder' => 'Saat',
	'article_publish_minutes_placeholder' => 'Dəqiqə',
	'article_gallery' => 'Qalereya',
	'article_author' => 'Müəllif',
	'article_title' => 'Başlıq',
	'article_keywords' => 'Açar sözləri',
	'article_short' => 'Qısa mətn',
	'article_full' => 'Mətn',
	'article_show_on_main_page' => 'Əsas səhifədə göstər',
	'article_show_on_main_page_filter' => 'Əsas səhifədə olanlar',
	'article_show_off_main_page_filter' => 'Əsas səhifədə olmayanlar',
	'article_is_highlighted' => 'Seçilmiş',
	'article_is_highlighted_filter' => 'Seçilmişlər',
	'article_add_err_title_empty' => 'Məqalənin başlığı boş ola bilməz',
	'article_add_err_full_empty' => 'Məqalənin mətni boş ola bilməz',
	'article_add_err_publish_date_invalid' => 'Dərc olunma tarixi yanlışdır',
	'article_add_err_publish_hour_invalid' => 'Dərc olunma saatı yanlışdır',
	'article_add_err_publish_minutes_invalid' => 'Dərc olunma dəqiqəsi yanlışdır',
	'article_add_err_gallery_not_exists' => 'Qalereya tapılmayıb',
	'article_add_err_source_url_invalid' => 'Mənbənin URL yanlışdır',
	'article_edit_err_not_found' => 'Məqalə tapılmayıb',
	'article_edit_err_sef_empty' => 'Məqalənin SEF URL boş ola bilməz',
	'articles_assignment' => 'Təyinat',


    // Start publications Content
    'menu_item_publications_list' => 'Nəşrlər',
    'menu_item_publication_add' => 'Nəşr əlavə et',
    'menu_item_publication_edit' => 'Nəşr redaktə et',
    'menu_item_publications_images' => 'Bu nəşrə aid şəkillər',
    'validate_err' => 'Müvafiq xanaları doldurun',
    'image_count_overflow' => 'Şəkillərin sayı 5 dən çoxdur',
    'publications_list_details' => '{count} nəşr tapılıb',
    'publication_add' => 'Nəşr əlavə et',
    'publication_image_descr' => '{types} formatlı faylların yüklənməsinə icazə verilir.',
    'publications_images_not_found' => 'Bu nəşrə aid heç bir şəkil tapılmadı.',
    'publication_news' => 'Xəbər',
    'publication_blog' => 'Blog',
    'publication_media' => 'Media',
    'publication_aphorism' => 'Aforizm',
    'publication_eco_bag' => 'Eco bag',
    'publication_corporate_offer' => 'Corporate offer',
    'publication_gift_card' => 'Gift card',
    'publication_title' => 'Başlıq',
    'publication_type' => 'Növ',
    'publication_is_hidden' => 'Saytda görülməsi',
    'publication_date' => 'Tarix',
    'publication_about_info' => 'Kompaniya haqqında məlumat',
    'filter_publication_type' => 'Nəşr növü',
    'filter_publication_visibility' => 'Saytda görülməsi',
    'filter_publication_date' => 'Tarix',
    'filter_visible' => 'Görülən',
    'filter_hidden' => 'Gizlədilmiş',
    'hear_from' => 'Bizim haqqında öyrənib',
    // End publications content //

    // Start services content //
    'menu_item_services_list' => 'Servislər',
    'menu_item_service_add' => 'Servis əlavə et',
    'menu_item_service_edit' => 'Servis redaktə et',
    'service_add' => 'Servis əlavə et',
    'services_list_details' => '{count} servis tapılıb',
    'filter_service_type' => 'Servis növü',
    'service_title' => 'Başlıq',
    'service_type' => 'Növ',
    // End services content //

    // Start services types content //
    'menu_item_services_types_list' => 'Servis növ siyahisi',
    'menu_item_service_type_edit' => 'Servis növ redaktə et',
    'service_type_add' => 'Servis növü əlavə et',
    'services_types_list_details' => '{count} servis növ tapılıb',
    'service_type_title' => 'Servis növü',
    // End services types content //

    // Start users content
    'menu_item_users_list' => 'Sayt istifadəçilər',
    'user_fio' => 'S.A.A',
    'user_email' => 'Email',
    'user_phone' => 'Mobil telefon',
    'user_request_date' => 'Tarix',
    'user_ip' => 'IP Adress',
    // End users content

    // Navigation

	'nav_menu' => 'Menyu',
	'nav_menu_structure' => 'Bəndlərin strukturu',
	'nav_menu_add_item' => 'Alt menyunun bəndini yarat',
	'nav_menu_del_item' => 'Seçilmiş bəndi sil',
	'nav_menu_edit_item' => 'Bəndinin baxışı / Redaktə edilməsi',
	'nav_menu_item_name' => 'Bəndin adı',
	'nav_menu_item_type' => 'Növ',
	'nav_menu_item_type_article' => 'Məqalə',
	'nav_menu_item_type_category' => 'Kateqoriya',
	'nav_menu_item_type_spec' => 'Xüsusi səhifə',
	'nav_menu_item_type_url' => 'Link',
	'nav_menu_item_sef' => 'SEF (unikal olmalıdır)',
	'nav_menu_item_ref_article' => 'Məqaləni seçin (2 hərflərdən sonra avtotamamlama)',
	'nav_menu_item_url' => 'URL',
	'nav_menu_item_url_descr' => 'Əqər əlavə olunan bəndin kontenti yoxdursa və o başqa bəndlər üçün ana bəndi kimi istifadə olunursa &ldquo;#&rdquo; simvolunu saxlayın.<br />
	Əqər URL sayt üçün lokaldısa ünvan &ldquo;/&rdquo; simvolu ilə başlamalıdır.
	Bütün qalan ünvanlar dəyişilməz olaraq qalacaq.<br />
	Həmçinin ünvanın dil versiyası dinamik əvəz edilməsi üçün &ldquo;{lang}&rdquo; ifadəsindən istifadə etmək olar',
	'nav_menu_item_position' => 'Mövqə',
	'nav_menu_item_is_section' => 'Bölmə (redaktora doldurulması üçün təyin oluna bilən kontent olan kateqoriya və ya xüsusi səhifə)',
	'nav_menu_add_item_err_type_invalid' => 'Növ yanlışdır',
	'nav_menu_add_item_err_sef_invalid' => 'SEF yanlışdır',
	'nav_menu_add_item_err_sef_exists' => 'Daxil etdiyiniz SEF artıq istifadə olunub',
	'nav_menu_add_item_err_article_id_empty' => 'Məqalə seçilməmişdir',
	'nav_menu_add_item_err_article_id_not_exists' => 'Məqalə tapılmayıb',
	'nav_menu_add_item_err_article_id_item_exists' => 'Seçilmiş məqalə artıq istifadə olunub',
	'nav_menu_add_item_err_name_empty' => 'Bəndin adı boş ola bilməz',
	'nav_menu_add_item_err_position_empty' => 'Heç bir mövqə seçilməyib',
	'nav_menu_edit_item_err_not_found' => 'Bənd tapılmayıb',
	'nav_menu_level_up' => 'Yuxarı',

	// Moderation - Site users

	'site_users_list_details' => '{count} istifadəçi tapılıb',
	'site_users_has_registered' => 'istifadəçi qeyd olunub',
	'site_user_profile_info' => 'Profil məlumatları',
	'site_user_email' => 'E-mail',
	'site_user_name' => 'Ad, soyad',
	'site_user_reg_date' => 'Qeydiyyat tarixi',
	'site_user_reg_date_since' => 'ilk',
	'site_user_reg_date_till' => 'son',
	'site_users_provider' => 'Provayder',
	'site_users_provider_none' => 'Müstəqil istifadəçi',
	'site_user_nickname' => 'Nik',
	'site_user_birth_date' => 'Təvəllüd',
	'site_user_gender' => 'Cins',
	'site_user_gender_male' => 'Kişi',
	'site_user_gender_female' => 'Qadın',
	'site_user_registration_datetime' => 'Qeydiyyat tarixi',
	'site_user_last_login_datetime' => 'Son daxil olma tarixi',
	'site_user_comments_count' => 'Şərhlərin sayı',

	// Moderation - Comments

	'comments_list_details' => '{count} şərh tapılıb',
	'comments_are_left' => 'şərh yazılıb',
	'comments_user' => 'İstifadəçi',
	'comments_preambula' => 'Mətn',
	'comment_text' => 'Mətn',
	'comments_posted_datetime' => 'Tarix',
	'comments_posted_datetime_since' => 'ilk',
	'comments_posted_datetime_till' => 'son',
	'comments_is_published' => 'Dərc edilib',
	'comments_is_inspected' => 'Admin tərəfindən baxılıb',
	'comment_inspected' => 'Admin tərəfindən baxılıb',
	'comment_not_inspected' => 'Admin tərəfindən baxılmayıb',
	'comments_moderate' => 'Moderasiya',
	'comments_moderate_allow' => 'Dərc et',
	'comments_moderate_deny' => 'Rədd et',

	// Moderation - Feedback

	'complaints_chat_list' => 'Yazışmaların siyahısı',
	'complaints_username' => 'İstifadəçinin SAA',
	'complaints_last_msg_date' => 'Sonuncu mesajın tarixi',
	'complaints_last_msg_short' => 'Sonuncu mesajın qısa mətni',
    'complaints_answeredness' => 'Cavablandırılma',
    'complaints_answeredness_all' => 'Hamısı',
    'complaints_answeredness_not' => 'Cavablandırılmayanlar',
    'complaints_answeredness_yep' => 'Cavablandırılmış',
	'complaints_answer_notification_sms' => 'Sizin müraciətiniz cavablandırıldı',
	'complaints_answer_notification_subj' => 'Sizin müraciətiniz cavablandırıldı',
	'complaints_answer_notification_email' => '<h1 style="font-size: medium; font-family: serif; font-weight: normal;">Hörmətli {username},</h1><p style="font-size: medium; font-family: serif; font-weight: normal;">Sizin müraciətiniz cavablandırılıb:</p><blockquote> {answer} </blockquote><p style="font-size: medium; font-family: serif; font-weight: normal;">Müraciətin mətni:</p><blockquote> {complaint} </blockquote>',
    'complaints_message_err' => 'Mətni daxil edin',
    'complaints_file_err' => 'Faylın formatı yanlışdır',
	'complaints_chat_with' => '{username} istifadəçi ilə yazışma',
	'complaints_answered' => 'Müraciət müvəffəqiyyətlə cavablandırılıb',
	'complaints_give_answer' => 'Cavab ver',

];

?>