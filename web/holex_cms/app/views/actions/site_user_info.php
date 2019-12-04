<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined('_VALID_PHP')) {
    die('Direct access to this location is not allowed.');
}

?>


<style>
    .provider-link {
        font-size: 14px;
    }

    .provider-link .fa {
        font-size: 14px;
    }

    .provider {
        vertical-align: baseline;
        height: 13px;
    }
</style>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= CMS::t('menu_item_site_users_view_info'); ?>
        <small><?= utils::safeEcho($user['fio'], 1); ?></small>
    </h1>
</section>

<!-- Content Header (Page header) -->
<section class="contextual-navigation">
    <nav>
        <a href="<?= utils::safeEcho($link_back, 1); ?>" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?= CMS::t('back'); ?></a>
    </nav>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?= view::gravatar($user['fio'], 120, ['class' => 'profile-user-img img-responsive img-circle']); ?>
                    <h3 class="profile-username text-center"><?= utils::safeEcho($user['fio'], 1); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-12">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab"><?= CMS::t('site_user_profile_info'); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Info tab -->
                    <div class="active tab-pane" id="activity">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th><?= CMS::t('user_fio'); ?></th>
                                <td>
                                    <?= utils::safeEcho($user['fio'], 1); ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= CMS::t('site_user_email'); ?></th>
                                <td><a href="mailto:<?= $user['email']; ?>"><i class="fa fa-envelope" aria-hidden="true"></i> <?= $user['email']; ?></a></td>
                            </tr>
                            <tr>
                                <th><?= CMS::t('user_phone'); ?></th>
                                <td><a href="tel:<?= $user['phone']; ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?= $user['phone']; ?></a></td>
                            </tr>
                            <tr>
                                <th><?= CMS::t('user_request_date'); ?></th>
                                <td><?= (empty($user['request_date']) ? '' : utils::formatMySQLDate('d.m.Y H:i', $user['request_date'])); ?></td>
                            </tr>
                            <tr>
                                <th><?= CMS::t('user_ip'); ?></th>
                                <td> <?= utils::safeEcho($user['ip_address'], 1); ?></td>
                            </tr>
                            <tr>
                                <th><?= CMS::t('access'); ?></th>
                                <td>
                                    <?php if (CMS::hasAccessTo('users/ajax_set_ban', 'write')) { ?>
                                        <a href="?controller=users&amp;action=ajax_set_ban" title="" class="aAjax btn-toggle" data-ajax_post="<?=utils::safeEcho(json_encode([
                                            'CSRF_token' => $CSRF_token,
                                            'user_id' => $user['id'],
                                            'turn' => ($user['is_blocked']? 'on': 'off')
                                        ]), 1);?>"><i class="fa fa-toggle-<?=($user['is_blocked']? 'off': 'on');?> btn-toggle-<?=($user['is_blocked']? 'off': 'on');?>" aria-hidden="true"></i></a>
                                    <?php } else { ?>
                                        <i class="fa fa-toggle-<?=($user['is_blocked']? 'off': 'on');?> btn-toggle-disabled" aria-hidden="true"></i>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= CMS::t('hear_from'); ?></th>
                                <td> <?= utils::safeEcho($user['hear_from'], 1); ?></td>
                            </tr>
                            <tr>
                                <th><?= CMS::t('article_title'); ?></th>
                                <td> <?= utils::safeEcho($user['title'], 1); ?></td>
                            </tr>
                            <tr>
                                <th><?= CMS::t('article_full'); ?></th>
                                <td> <?= utils::safeEcho($user['text'], 1); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function() {
        $('.aAjax').on('click', function() {
            var $el = $(this);
            var data = JSON.parse($(this).attr('data-ajax_post'));
            $.ajax({
                url: this.href,
                data: data,
                async: true,
                cache: false,
                type: 'post',
                dataType: 'json',
                success: function(response, status, xhr) {
                    if (response.success) {
                        if (response.data && response.data.action) {
                            var new_status = response.data.action;
                            var old_status = ((new_status=='on')? 'off': 'on');
                            $('i', $el).removeClass('fa-toggle-'+old_status+' btn-toggle-'+old_status).addClass('fa-toggle-'+new_status+' btn-toggle-'+new_status);
                            data.turn = old_status;
                            $el.attr('data-ajax_post', JSON.stringify(data));
                        }
                    }
                },
                error: function(xhr, err, descr) {}
            });

            return false;
        });
    });
    // ]]>
</script>