<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 12/1/2017
 * Time: 1:43 PM
 */

/**
 * 时间友好型提示风格化（即微博中的XXX小时前、昨天等等）
 *
 * 即微博中的 XXX 小时前、昨天等等, 时间超过 $time_limit 后返回按 out_format 的设定风格化时间戳
 *
 * @param  int
 * @param  int
 * @param  string
 * @param  array
 * @param  int
 * @return string
 */
function date_friendly($timestamp, $time_limit = 604800, $out_format = 'Y-m-d H:i', $formats = null, $time_now = null)
{
    if (get_setting('time_style') == 'N')
    {
        return date($out_format, $timestamp);
    }

    if (!$timestamp)
    {
        return false;
    }

    if ($formats == null)
    {
        $formats = array('YEAR' => AWS_APP::lang()->_t('%s 年前'), 'MONTH' => AWS_APP::lang()->_t('%s 月前'), 'DAY' => AWS_APP::lang()->_t('%s 天前'), 'HOUR' => AWS_APP::lang()->_t('%s 小时前'), 'MINUTE' => AWS_APP::lang()->_t('%s 分钟前'), 'SECOND' => AWS_APP::lang()->_t('%s 秒前'));
    }

    $time_now = $time_now == null ? time() : $time_now;
    $seconds = $time_now - $timestamp;

    if ($seconds == 0)
    {
        $seconds = 1;
    }

    if (!$time_limit OR $seconds > $time_limit)
    {
        return date($out_format, $timestamp);
    }

    $minutes = floor($seconds / 60);
    $hours = floor($minutes / 60);
    $days = floor($hours / 24);
    $months = floor($days / 30);
    $years = floor($months / 12);

    if ($years > 0)
    {
        $diffFormat = 'YEAR';
    }
    else
    {
        if ($months > 0)
        {
            $diffFormat = 'MONTH';
        }
        else
        {
            if ($days > 0)
            {
                $diffFormat = 'DAY';
            }
            else
            {
                if ($hours > 0)
                {
                    $diffFormat = 'HOUR';
                }
                else
                {
                    $diffFormat = ($minutes > 0) ? 'MINUTE' : 'SECOND';
                }
            }
        }
    }

    $dateDiff = null;

    switch ($diffFormat)
    {
        case 'YEAR' :
            $dateDiff = sprintf($formats[$diffFormat], $years);
            break;
        case 'MONTH' :
            $dateDiff = sprintf($formats[$diffFormat], $months);
            break;
        case 'DAY' :
            $dateDiff = sprintf($formats[$diffFormat], $days);
            break;
        case 'HOUR' :
            $dateDiff = sprintf($formats[$diffFormat], $hours);
            break;
        case 'MINUTE' :
            $dateDiff = sprintf($formats[$diffFormat], $minutes);
            break;
        case 'SECOND' :
            $dateDiff = sprintf($formats[$diffFormat], $seconds);
            break;
    }

    return $dateDiff;
}

/**
 * 通用加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @return String
 */
function enCode($string = '', $skey = 'fb')
{
    $skey = array_reverse(str_split($skey));
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach ($skey as $key => $value) {
        $key < $strCount && $strArr[$key] .= $value;
    }
    return str_replace('=', 'O0O0O', join('', $strArr));
}

/**
 * 通用解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @return String
 */
function deCode($string = '', $skey = 'fb') {
    $skey = array_reverse(str_split($skey));
    $strArr = str_split(str_replace('O0O0O', '=', $string), 2);
    $strCount = count($strArr);
    foreach ($skey as $key => $value) {
        $key < $strCount && $strArr[$key] = rtrim($strArr[$key], $value);
    }
    return base64_decode(join('', $strArr));
}


/**
 * 随机字符串
 * @param $length
 * @return null|string
 */
function randomCode($length){
    $str = null;
    $strPol = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $max = strlen($strPol)-1;

    for($i=0;$i<$length;$i++) {
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }
    return $str;
}


/**
 * 兼容性转码
 *
 * 系统转换编码调用此函数, 会自动根据当前环境采用 iconv 或 MB String 处理
 *
 * @param  string
 * @param  string
 * @param  string
 * @return string
 */
function convert_encoding($string, $from_encoding = 'GBK', $target_encoding = 'UTF-8')
{
    if (function_exists('mb_convert_encoding'))
    {
        return mb_convert_encoding($string, str_replace('//IGNORE', '', strtoupper($target_encoding)), $from_encoding);
    }
    else
    {
        if (strtoupper($from_encoding) == 'UTF-16')
        {
            $from_encoding = 'UTF-16BE';
        }

        if (strtoupper($target_encoding) == 'UTF-16')
        {
            $target_encoding = 'UTF-16BE';
        }

        if (strtoupper($target_encoding) == 'GB2312' or strtoupper($target_encoding) == 'GBK')
        {
            $target_encoding .= '//IGNORE';
        }

        return iconv($from_encoding, $target_encoding, $string);
    }
}

/**
 * 兼容性转码 (数组)
 *
 * 系统转换编码调用此函数, 会自动根据当前环境采用 iconv 或 MB String 处理, 支持多维数组转码
 *
 * @param  array
 * @param  string
 * @param  string
 * @return array
 */
function convert_encoding_array($data, $from_encoding = 'GBK', $target_encoding = 'UTF-8')
{
    return eval('return ' . convert_encoding(var_export($data, true) . ';', $from_encoding, $target_encoding));
}

/**
 * 双字节语言版 strpos
 *
 * 使用方法同 strpos()
 *
 * @param  string
 * @param  string
 * @param  int
 * @param  string
 * @return string
 */
function cjk_strpos($haystack, $needle, $offset = 0, $charset = 'UTF-8')
{
    if (function_exists('iconv_strpos'))
    {
        return iconv_strpos($haystack, $needle, $offset, $charset);
    }

    return mb_strpos($haystack, $needle, $offset, $charset);
}

/**
 * 双字节语言版 substr
 *
 * 使用方法同 substr(), $dot 参数为截断后带上的字符串, 一般场景下使用省略号
 *
 * @param  string
 * @param  int
 * @param  int
 * @param  string
 * @param  string
 * @return string
 */
function cjk_substr($string, $start, $length, $charset = 'UTF-8', $dot = '')
{
    if (cjk_strlen($string, $charset) <= $length)
    {
        return $string;
    }

    if (function_exists('mb_substr'))
    {
        return mb_substr($string, $start, $length, $charset) . $dot;
    }
    else
    {
        return iconv_substr($string, $start, $length, $charset) . $dot;
    }
}

/**
 * 双字节语言版 strlen
 *
 * 使用方法同 strlen()
 *
 * @param  string
 * @param  string
 * @return string
 */
function cjk_strlen($string, $charset = 'UTF-8')
{
    if (function_exists('mb_strlen'))
    {
        return mb_strlen($string, $charset);
    }
    else
    {
        return iconv_strlen($string, $charset);
    }
}

/**
 * 递归创建目录
 *
 * 与 mkdir 不同之处在于支持一次性多级创建, 比如 /dir/sub/dir/
 *
 * @param  string
 * @param  int
 * @return boolean
 */
function make_dir($dir, $permission = 0777)
{
    $dir = rtrim($dir, '/') . '/';

    if (is_dir($dir))
    {
        return TRUE;
    }

    if (! make_dir(dirname($dir), $permission))
    {
        return FALSE;
    }

    return @mkdir($dir, $permission);
}


// ------------------------------------------------------------------------


/**
 * 根据 salt 混淆密码
 *
 * @param  string
 * @param  string
 * @return string
 */
function compile_password($password, $salt)
{
    $password = md5(md5($password) . $salt);

    return $password;
}

/**
 * 伪静态地址转换器
 *
 * @param  string
 * @return string
 */
function get_js_url($url)
{
    if (substr($url, 0, 1) == '/')
    {
        $url = substr($url, 1);

        if (get_setting('url_rewrite_enable') == 'Y' AND $request_routes = get_request_route())
        {
            if (strstr($url, '?'))
            {
                $request_uri = explode('?', $url);

                $query_string = $request_uri[1];

                $url = $request_uri[0];
            }
            else
            {
                unset($query_string);
            }

            foreach ($request_routes as $key => $val)
            {
                if (preg_match('/^' . $val[0] . '$/', $url))
                {
                    $url = preg_replace('/^' . $val[0] . '$/', $val[1], $url);

                    break;
                }
            }

            if ($query_string)
            {
                $url .= '?' . $query_string;
            }
        }

        $url = base_url() . '/' . ((get_setting('url_rewrite_enable') != 'Y') ? G_INDEX_SCRIPT : '') . $url;
    }

    return $url;
}

/**
 * 用于分页查询 SQL 的 limit 参数生成器
 *
 * @param  int
 * @param  int
 * @return string
 */
function calc_page_limit($page, $per_page)
{
    if (intval($per_page) == 0)
    {
        throw new Zend_Exception('Error param: per_page');
    }

    if ($page < 1)
    {
        $page = 1;
    }

    return ((intval($page) - 1) * intval($per_page)) . ', ' . intval($per_page);
}

/**
 * 将用户登录信息编译成 hash 字符串，用于发送 Cookie
 *
 * @param  string
 * @param  string
 * @param  string
 * @param  integer
 * @param  boolean
 * @return string
 */
function get_login_cookie_hash($user_name, $password, $salt, $uid, $hash_password = true)
{
    if ($hash_password)
    {
        $password = compile_password($password, $salt);
    }

    $auth_hash_key = md5(G_COOKIE_HASH_KEY . $_SERVER['HTTP_USER_AGENT']);

    return AWS_APP::crypt()->encode(json_encode(array(
        'uid' => $uid,
        'user_name' => $user_name,
        'password' => $password
    )), $auth_hash_key);
}

/**
 * 检查队列中是否存在指定的 hash 值, 并移除之, 用于表单提交验证
 *
 * @param  string
 * @return boolean
 */
function valid_post_hash($hash)
{
    return AWS_APP::form()->valid_post_hash($hash);
}

/**
 * 创建一个新的 hash 字符串，并写入 hash 队列, 用于表单提交验证
 *
 * @return string
 */
function new_post_hash()
{
    if (! AWS_APP::session()->client_info)
    {
        return false;
    }

    return AWS_APP::form()->new_post_hash();
}

/**
 * 构造或解析路由规则后得到的请求地址数组
 *
 * 返回二维数组, 二位数组, 每个规则占据一条, 被处理的地址通过下标 0 返回, 处理后的地址通过下标 1 返回
 *
 * @param  boolean
 * @return array
 */
function get_request_route($positive = true)
{
    if (!$route_data = get_setting('request_route_custom'))
    {
        return false;
    }

    if ($request_routes = explode("\n", $route_data))
    {
        $routes = array();

        $replace_array = array("(:any)" => "([^\"'&#\?\/]+[&#\?\/]*[^\"'&#\?\/]*)", "(:num)" => "([0-9]+)");

        foreach ($request_routes as $key => $val)
        {
            $val = trim($val);

            if (!$val)
            {
                continue;
            }

            if ($positive)
            {
                list($pattern, $replace) = explode('===', $val);
            }
            else
            {
                list($replace, $pattern) = explode('===', $val);
            }

            if (substr($pattern, 0, 1) == '/' and $pattern != '/')
            {
                $pattern = substr($pattern, 1);
            }

            if (substr($replace, 0, 1) == '/' and $replace != '/')
            {
                $replace = substr($replace, 1);
            }

            $pattern = addcslashes($pattern, "/\.?");

            $pattern = str_replace(array_keys($replace_array), array_values($replace_array), $pattern);

            $replace = str_replace(array_keys($replace_array), "\$1", $replace);

            $routes[] = array($pattern, $replace);
        }

        return $routes;
    }
}

/**
 * 删除 UBB 标识码
 *
 * @param  string
 * @return string
 */
function strip_ubb($str)
{
    //$str = preg_replace('/\[attach\]([0-9]+)\[\/attach]/', '<i>** ' . AWS_APP::lang()->_t('插入的附件') . ' **</i>', $str);
    $str = preg_replace('/\[[^\]]+\](http[s]?:\/\/[^\[]*)\[\/[^\]]+\]/', ' $1 ', $str);

    $pattern = '/\[[^\]]+\]([^\[]*)\[\/[^\]]+\]/';
    $replacement = ' $1 ';
    return preg_replace($pattern, $replacement, preg_replace($pattern, $replacement, $str));
}

/**
 * 获取数组中随机一条数据
 *
 * @param  array
 * @return mixed
 */
function array_random($arr)
{
    shuffle($arr);

    return end($arr);
}

/**
 * 获得二维数据中第二维指定键对应的值，并组成新数组 (不支持二维数组)
 *
 * @param  array
 * @param  string
 * @return array
 */
function fetch_array_value($array, $key)
{
    if (!$array || ! is_array($array))
    {
        return array();
    }

    $data = array();

    foreach ($array as $_key => $val)
    {
        $data[] = $val[$key];
    }

    return $data;
}

/**
 * 强制转换字符串为整型, 对数字或数字字符串无效
 *
 * @param  mixed
 */
function intval_string(&$value)
{
    if (! is_numeric($value))
    {
        $value = intval($value);
    }
}

/**
 * 获取时差
 *
 * @return string
 */
function get_time_zone()
{
    $time_zone = 0 + (date('O') / 100);

    if ($time_zone == 0)
    {
        return '';
    }

    if ($time_zone > 0)
    {
        return '+' . $time_zone;
    }

    return $time_zone;
}

/**
 * 格式化输出相应的语言
 *
 * 根据语言包中数组键名的下标获取对应的翻译字符串
 *
 * @param  string
 * @param  string
 */
function _e($string, $replace = null)
{
    if (!class_exists('AWS_APP', false))
    {
        echo load_class('core_lang')->translate($string, $replace, TRUE);
    }
    else
    {
        echo AWS_APP::lang()->translate($string, $replace, TRUE);
    }
}

/**
 * 递归读取文件夹的文件列表
 *
 * 读取的目录路径可以是相对路径, 也可以是绝对路径, $file_type 为指定读取的文件后缀, 不设置则读取文件夹内所有的文件
 *
 * @param  string
 * @param  string
 * @return array
 */
function fetch_file_lists($dir, $file_type = null)
{
    if ($file_type)
    {
        if (substr($file_type, 0, 1) == '.')
        {
            $file_type = substr($file_type, 1);
        }
    }

    $base_dir = realpath($dir);

    if (!file_exists($base_dir))
    {
        return false;
    }

    $dir_handle = opendir($base_dir);

    $files_list = array();

    while (($file = readdir($dir_handle)) !== false)
    {
        if (substr($file, 0, 1) != '.' AND !is_dir($base_dir . '/' . $file))
        {
            if (($file_type AND H::get_file_ext($file, false) == $file_type) OR !$file_type)
            {
                $files_list[] = $base_dir . '/' . $file;
            }
        }
        else if (substr($file, 0, 1) != '.' AND is_dir($base_dir . '/' . $file))
        {
            if ($sub_dir_lists = fetch_file_lists($base_dir . '/' . $file, $file_type))
            {
                $files_list = array_merge($files_list, $sub_dir_lists);
            }
        }
    }

    return $files_list;
}

/**
 * 判断是否是合格的手机客户端
 *
 * modified 2016-12-23 这个函数改了，所有wc的ismobile都返回false
 *
 * @return boolean
 */
function is_mobile($ignore_cookie = false)
{

    return false;

    if (HTTP::get_cookie('_ignore_ua_check') == 'TRUE' AND !$ignore_cookie)
    {
        return false;
    }

    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

    if (preg_match('/playstation/i', $user_agent) OR preg_match('/ipad/i', $user_agent) OR preg_match('/ucweb/i', $user_agent))
    {
        return false;
    }

    if (preg_match('/iemobile/i', $user_agent) OR preg_match('/mobile\ssafari/i', $user_agent) OR preg_match('/iphone\sos/i', $user_agent) OR preg_match('/android/i', $user_agent) OR preg_match('/symbian/i', $user_agent) OR preg_match('/series40/i', $user_agent))
    {
        return true;
    }

    return false;
}

function is_tec_mobile($ignore_cookie = false)
{

    if (HTTP::get_cookie('_ignore_ua_check') == 'TRUE' AND !$ignore_cookie)
    {
        return false;
    }

    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

    if (preg_match('/playstation/i', $user_agent) OR preg_match('/ipad/i', $user_agent) OR preg_match('/ucweb/i', $user_agent))
    {
        return false;
    }

    if (preg_match('/iemobile/i', $user_agent) OR preg_match('/mobile\ssafari/i', $user_agent) OR preg_match('/iphone\sos/i', $user_agent) OR preg_match('/android/i', $user_agent) OR preg_match('/symbian/i', $user_agent) OR preg_match('/series40/i', $user_agent))
    {
        return true;
    }

    return false;
}

/**
 * 判断是否处于微信内置浏览器中
 *
 * @return boolean
 */
function in_weixin()
{
    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

    if (preg_match('/micromessenger/i', $user_agent))
    {
        return true;
    }

    return false;
}

/**
 * CURL 获取文件内容
 *
 * 用法同 file_get_contents
 *
 * @param string
 * @param integerr
 * @return string
 */
function curl_get_contents($url, $timeout = 30)
{
    return HTTP::request($url, 'GET', null, $timeout);
}

/**
 * 生成一段时间的月份列表
 *
 * @param string
 * @param string
 * @param string
 * @param string
 * @return array
 */
function get_month_list($timestamp1, $timestamp2, $year_format = 'Y', $month_format = 'm')
{
    $yearsyn = date($year_format, $timestamp1);
    $monthsyn = date($month_format, $timestamp1);
    $daysyn = date('d', $timestamp1);

    $yearnow = date($year_format, $timestamp2);
    $monthnow = date($month_format, $timestamp2);
    $daynow = date('d', $timestamp2);

    if ($yearsyn == $yearnow)
    {
        $monthinterval = $monthnow - $monthsyn;
    }
    else if ($yearsyn < $yearnow)
    {
        $yearinterval = $yearnow - $yearsyn -1;
        $monthinterval = (12 - $monthsyn + $monthnow) + 12 * $yearinterval;
    }

    $timedata = array();
    for ($i = 0; $i <= $monthinterval; $i++)
    {
        $tmptime = mktime(0, 0, 0, $monthsyn + $i, 1, $yearsyn);
        $timedata[$i]['year'] = date($year_format, $tmptime);
        $timedata[$i]['month'] = date($month_format, $tmptime);
        $timedata[$i]['beginday'] = '01';
        $timedata[$i]['endday'] = date('t', $tmptime);
    }

    $timedata[0]['beginday'] = $daysyn;
    $timedata[$monthinterval]['endday'] = $daynow;

    unset($tmptime);

    return $timedata;
}

/**
 * EML 文件解码
 *
 * @param string
 * @return string
 */
function decode_eml($string)
{
    $pos = strpos($string, '=?');

    if (!is_int($pos))
    {
        return $string;
    }

    $preceding = substr($string, 0, $pos);	// save any preceding text
    $search = substr($string, $pos + 2);	// the mime header spec says this is the longest a single encoded word can be
    $part_1 = strpos($search, '?');

    if (!is_int($part_1))
    {
        return $string;
    }

    $charset = substr($string, $pos + 2, $part_1);	// 取出字符集的定义部分
    $search = substr($search, $part_1 + 1);	// 字符集定义以后的部分 => $search

    $part_2 = strpos($search, '?');

    if (!is_int($part_2))
    {
        return $string;
    }

    $encoding = substr($search, 0, $part_2);	// 两个?　之间的部分编码方式: q 或 b　
    $search = substr($search, $part_2 + 1);
    $end = strpos($search, '?=');	// $part_2 + 1 与 $end 之间是编码了的内容: => $endcoded_text;

    if (!is_int($end))
    {
        return $string;
    }

    $encoded_text = substr($search, 0, $end);
    $rest = substr($string, (strlen($preceding . $charset . $encoding . $encoded_text) + 6));	// + 6 是前面去掉的 =????= 六个字符

    switch (strtolower($encoding))
    {
        case 'q':
            $decoded = quoted_printable_decode($encoded_text);

            if (strtolower($charset) == 'windows-1251')
            {
                $decoded = convert_cyr_string($decoded, 'w', 'k');
            }
            break;

        case 'b':
            $decoded = base64_decode($encoded_text);

            if (strtolower($charset) == 'windows-1251')
            {
                $decoded = convert_cyr_string($decoded, 'w', 'k');
            }
            break;

        default:
            $decoded = '=?' . $charset . '?' . $encoding . '?' . $encoded_text . '?=';
            break;
    }

    return $preceding . $decoded . decode_eml($rest);
}

function array_key_sort_asc_callback($a, $b)
{
    if ($a['sort'] == $b['sort'])
    {
        return 0;
    }

    return ($a['sort'] < $b['sort']) ? -1 : 1;
}

function get_random_filename($dir, $file_ext)
{
    if (!$dir OR !file_exists($dir))
    {
        return false;
    }

    $dir = rtrim($dir, '/') . '/';

    $filename = md5(mt_rand(1, 99999999) . microtime());

    if (file_exists($dir . $filename . '.' . $file_ext))
    {
        return get_random_filename($dir, $file_ext);
    }

    return $filename . '.' . $file_ext;
}

function check_extension_package($package)
{
    if (!file_exists(ROOT_PATH . 'models/' . $package . '.php'))
    {
        return false;
    }

    return true;
}

function get_left_days($timestamp)
{
    $left_days = intval(($timestamp - time()) / (3600 * 24));

    if ($left_days < 0)
    {
        $left_days = 0;
    }

    return $left_days;
}

function get_paid_progress_bar($amount, $paid)
{
    if ($amount == 0)
    {
        return 0;
    }

    return intval(($paid / $amount) * 100);
}


function uniqid_generate($length = 16)
{
    return substr(strtolower(md5(uniqid(rand()))), 0, $length);
}

/**
 * 获取请求ip
 * @return string
 */
function get_remote_ip(){
    $ip='未知IP';
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        return is_ip($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:$ip;
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return is_ip($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$ip;
    }else{
        return is_ip($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:$ip;
    }
}

/**
 * 是否是ip地址
 * @param $str
 * @return bool|int
 */
function is_ip($str){
    $ip=explode('.',$str);
    for($i=0;$i<count($ip);$i++){
        if($ip[$i]>255){
            return false;
        }
    }
    return preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/',$str);
}

/**
 * 是否是一个正常的手机号
 * @param $mobile
 * @return bool
 */
function is_mobile_number($mobile) {
    if (!is_numeric($mobile)) {
        return false;
    }

    if(strlen($mobile) == 11) return true;
    return false;

    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8,1]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}



/*
 * 格式化有效日期
 */
function format_youxiaoqi($date) {
    $datetime = date("Y-m-d H:i:s", intval($date));
    return $datetime;
}

/**
 * 是否使用uid注册emcaht
 * @return bool
 */
function use_uid_for_emchat(){
    $domin_array = get_setting('use_uid_for_emchat_domins');

    foreach ($domin_array as $domin){
        //如果base_url包含了domin，返回true
        if(strstr(base_url(),$domin)){
            return true;
        }
    }
    return false;

}

/**
 * 是否是自由栏目
 *
 */
function is_self_column($category_id){

    if(in_array($category_id,array(6,7,8,9))){
        return true;
    }
    return false;

}


function _cut($begin,$end,$str){
    $b = mb_strpos($str,$begin) + mb_strlen($begin);
    $e = mb_strpos($str,$end) - $b;

    return mb_substr($str,$b,$e);
}
