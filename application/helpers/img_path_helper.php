<?php
/**
 * Created by PhpStorm.
 * User: zhengxiangyue
 * Date: 8/2/2017
 * Time: 9:49 AM
 */

/**
 * 获取头像地址
 *
 * 举个例子：$uid=12345，那么头像路径很可能(根据您部署的上传文件夹而定)会被存储为/uploads/000/01/23/45_avatar_min.jpg
 *
 * @param  int
 * @param  string
 * @param  int
 * @return string
 */
function get_avatar($uid, $size = 'max', $return_type = 0)
{
    $size = in_array($size, array(
        'max',
        'rec',
        'squ'
    )) ? $size : 'real';

    $uid = abs(intval($uid));
    $uid = sprintf('%\'09d', $uid);

    $dir1 = substr($uid, 0, 3);
    $dir2 = substr($uid, 3, 2);
    $dir3 = substr($uid, 5, 2);

    if ($return_type == 1)
    {
        return $dir1 . '/' . $dir2 . '/' . $dir3 . '/';
    }

    if ($return_type == 2)
    {
        return substr($uid, -2) . '_avatar_' . $size . '.jpg';
    }

    return $dir1 . '/' . $dir2 . '/' . $dir3 . '/' . substr($uid, -2) . '_avatar_' . $size . '.jpg';
}

function get_attach_img($attach_id,$return_type){

    $year = date('Y');

    $month = date('m');

    $day = date('d');

}

