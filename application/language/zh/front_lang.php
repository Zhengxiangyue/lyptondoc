<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 2/3/2017
 * Time: 11:19 PM
 */

$hint_lang = array(
    'front_title'                   => 'Lypton doc',
    'page_preview'                  => '页面预览',

    'hint_user_not_login'           => '用户未登录',
    'hint_illegal_request'          => '非法参数',

    'register_parameters_err'       => '注册参数错误',
    'user_has_already_registered'   => '该用户已经注册过',
    'ssl_decryption_errror'         => '非法加密数据',
    'login_parameters_err'          => '登陆参数错误',
    'username_or_password_incorrect'=> '用户名或密码错误',
    'user_already_login'            => '用户已经处于登陆状态',
    'user_logout_success'           => '用户退出成功',
    'user_login_success'            => '用户登录成功',

    'save'                          => '保存',


);

if(!isset($lang))
{
    $lang = array();
}

$lang = array_merge($hint_lang,$lang);
