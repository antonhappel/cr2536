<?php
/**
 * Project: Flirtbar V2
 * User: flirtbar
 * Date: 07.04.14
 * Time: 17:20
 */


return array(

    //General site configuration
    'site_config' => array(
        'site_name' => 'club 1248'
    ),

    //Used Views in this package
    'views' => array(
        'layout_backend' => 'layouts.default',
        'layout_newbackend' => 'layouts.newdefault',
        'layout_login' => 'layouts.login',
        'login' => 'security.login',
        'dashboard' => 'dashboard.main',
        'admin_dashboard' => 'admin.main',
    ),

    //Used Email Views in this package
    'email_views' => array(
        'user_login' => 'web::common.email.login',
    ),
);