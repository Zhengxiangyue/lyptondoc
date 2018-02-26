<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 14/1/2017
 * Time: 5:34 PM
 */

/**
 * Class Base 所有控制器继承的基类
 *
 * @property CI_Encryption $encryption
 * @property CI_DB_query_builder $db
 * @property CI_Cache $cache
 * @property user_model $user_model
 * @property folder_model $folder_model
 * @property page_model $page_model
 */
class Base extends CI_Controller{

    /**
     * @var string
     * the name of this app
     */
    private static $app_name = 'lyptonDoc';

    /**
     * @var string
     */
    private static $cooike_sid_key = 'lyptonDoc_sid';

    /**
     * @var string
     */
    private static $session_expire_key = 'lyptonDoc_expire';

    /**
     * uid
     * @var
     */
    protected $user_id = null;

    /**
     * @var
     */
    protected $user_info;


    /**
     * Base constructor.
     */
    public function __construct()
    {
        parent::__construct();
        MY_Log::write_log($this->get_ip());
    }

    /**
     * 获取ip地址
     * @return string
     */
    private function get_ip(){
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif(!empty($_SERVER["REMOTE_ADDR"])){
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else{
            $cip = "无法获取！";
        }
        return $cip;
    }

    /**
     * 接口检查用户，检查失效直接response
     *
     */
    protected function check_user()
    {
        if(!$this->check_token())
        {
            $this->request_err(null,lang('hint_user_not_login'),-10);
        }

        return 1;
    }

    /**
     * @return bool
     */
    protected function check_token()
    {
        $this->user_info = $this->check_user_login_cookie();

        if(!$this->user_info) return false;
        $this->user_id = $this->user_info['uid'];
        return true;
    }


    /**
     * 检查登陆token
     * @return array | bool 检查失败返回false 成功返回用户信息
     */
    protected function check_user_login_cookie()
    {

        // if there is no app_name_sid cookie in on the client return false
        // if there is no session expire on the server OR the time has expired, return false
        if(!isset($_COOKIE[self::$cooike_sid_key]) OR !$this->read_session(self::$session_expire_key) OR $this->read_session(self::$session_expire_key) < time())
        {
            return false;
        }

        $content_str = $this->encryption->decrypt($_COOKIE[self::$cooike_sid_key]);

        // decrypt failed, return false, maybe someone is trying to attack the system

        if(!$content_str)
        {
            return false;
        }

        $content_arr = unserialize($content_str);

        // user without uid or email is invalid

        if(!isset($content_arr['uid']) OR !isset($content_arr['email']))
        {
            return false;
        }

        return $content_arr;
    }

    /**
     * @param $user_data_array
     */
    public static function set_user_login_cookie($user_data_array, $encryption, $expire = 86400)
    {
        $user_data_array['expire'] = time() + $expire;

        setcookie(self::$cooike_sid_key,$encryption->encrypt(serialize($user_data_array)),$user_data_array['expire']);

        session_start();
        $_SESSION[self::$session_expire_key] = $user_data_array['expire'];
        session_write_close();

        return;
    }

    /**
     * 销毁客户端cookie凭证
     *
     */
    public static function destry_user_login_cookie()
    {
        setcookie(self::$cooike_sid_key,'',time()-5);

        session_start();
        $_SESSION[self::$session_expire_key] = time();
        session_write_close();

        return;
    }

    /**
     * @param $data
     * @param string $msg
     * @param int $code
     */
    public function request_success($data, $msg = '', $code=1)
    {
        // 杜绝接口返回null值
        if($data === null) $data = (object)$data;
        $array = array(
            'data' => $data,
            'msg' => $msg,
            'code' => $code,
        );
        echo str_replace(array("\r", "\n", "\t"), '', json_encode($array));
        exit;
    }

    /**
     * @param $data
     * @param string $msg
     * @param int $code
     */
    public function request_err($data, $msg = '', $code=-1)
    {
        // 杜绝接口返回null值
        if($data === null) $data = (object)$data;
        $array = array(
            'data' => $data,
            'msg' => $msg,
            'code' => $code,
        );
        echo str_replace(array("\r", "\n", "\t"), '', json_encode($array));
        exit;
    }

    /**
     * 过滤white_list中的数据到返回数组
     * @param $white_list
     * @return array|bool
     */
    public function filter_post_data($white_list, $must = false, $html_encode = true)
    {
        if(!is_array($white_list)) return false;
        $data_array = array();
        foreach ($white_list as $item)
        {
            if(isset($_POST[$item]))
            {
                $data_array[$item] = $html_encode ? htmlspecialchars($_POST[$item]) : $_POST[$item];
            }else{
                if($must) $this->request_err(null,lang('hint_illegal_request'));
                $data_array[$item] = NULL;
            }
        }
        return $data_array;
    }

    /**
     * get encryption key
     *
     */
    public function create_encryption_key()
    {
        echo bin2hex($this->encryption->create_key(16));
    }

    /**
     * set session
     */
    public function read_session($key)
    {
        session_start();
        $session = isset($_SESSION[$key]) ? $_SESSION[$key] : false;
        session_write_close();
        return $session ;
    }

    public function set_session($key, $value)
    {
        session_start();
        $_SESSION[$key] = $value;
        session_write_close();
        return ;
    }


    /**
     * 给推送服务器发送数据
     * @param $data array('type'=>0,'data'=>array())
     */
    protected function push($data)
    {
        // 建立socket连接到内部推送端口
        $client = stream_socket_client('tcp://127.0.0.1:5678', $errno, $errmsg, 1);
        // 推送的数据，包含uid字段，表示是给这个uid推送
//        $data = array('uid'=>'uid1', 'percent'=>'88%');
        // 发送数据，注意5678端口是Text协议的端口，Text协议需要在数据末尾加上换行符
        fwrite($client, json_encode($data)."\n");
        // 读取推送结果
        echo fread($client, 8192);
    }

}