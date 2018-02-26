<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 11/3/2017
 * Time: 2:12 PM
 */

class MY_Log extends Seaslog{

    public function __construct()
    {
        if(!is_dir(dirname(APPPATH)."/log/".date('Ym')."/"))
        {
            mkdir(dirname(APPPATH)."/log/".date('Ym')."/");
        }

        Seaslog::setBasePath(dirname(APPPATH)."/log/".date('Ym')."/");

        Seaslog::setLogger('module');

    }
//
    public static function write_log($message, $level = 'info', array $content = array(), $module = 'module')
    {
        return Seaslog::$level($message,$content, $module);
    }

}