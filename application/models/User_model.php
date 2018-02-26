<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 8/3/2017
 * Time: 11:10 AM
 */

/**
 * @property user_model $user_model
 */
class user_model extends CI_Model
{

    /**
     * user_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $data_arr
     * @return array
     */
    public function common_user_register($data_arr)
    {
        if (empty($data_arr['email']) OR empty($data_arr['password']) OR empty($data_arr['userName']))
        {
            return $this->model_err(lang('register_parameters_err'));
        }

        // check the ssl encrypted password and decrypt the password

        if (!$data_arr['password'] = MY_ssl::decrypt($data_arr['password']))
        {
            return $this->model_err(lang('ssl_decryption_errror'));
        }

        // check if user's email has already exist

        if ($this->user_exists($data_arr['email']))
        {
            return $this->model_err(lang('user_has_already_registered'));
        }

        $salt = random_string('alpha', 4);

        // insert user info into database
        $result = $this->db->insert('users', array(
                'email' => $data_arr['email'],
                'userName' => $data_arr['userName'],
                'password' => $this->db_encrypt_password($data_arr['password'], $salt),
                'salt' => $salt,
                'regTime' => date('Y-m-d H:i:s'))
        );

        return $this->model_success($result);

    }

    /**
     * logic for common user login
     * @return array
     *
     */
    public function common_user_login($data_arr)
    {
        if (empty($data_arr['email']) OR empty($data_arr['password']))
        {
            return $this->model_err(lang('login_parameters_err'));
        }

        // check the ssl encrypted password and decrypt the password

        if (!$data_arr['password'] = MY_ssl::decrypt($data_arr['password']))
        {
            return $this->model_err(lang('ssl_decryption_errror'));
        }

        // check if the passowrd is true, if valid user_info is array

        $user_info = $this->get_user_info_by_email($data_arr['email'],$data_arr['password']);

        if(!$user_info)
        {
            return $this->model_err(lang('username_or_password_incorrect'));
        }

        // set cookie and tell front where to go
        Base::set_user_login_cookie($user_info,$this->encryption);

        return $this->model_success(array('url'=>'go where you want'));

    }

    /**
     *
     */
    public function common_user_logout()
    {
        Base::destry_user_login_cookie();
    }

    /**
     * @param $email
     * @return bool
     */
    public function user_exists($email)
    {
        if(empty($email)) return false;

        $user = $this->db->select('uid')->where('email',$email)->get('users')->row_array();

        return $user ? $user['uid'] : false;
    }

    /**
     * get user info from cache or db
     * @return bool | array
     */
    public function get_user_info_by_email($email, $password, $check_password = true, $cache = true)
    {
        if(empty($email)) return false;

        // currently we don't want to use cache

        $user_info = $this->db->select()->where('email',$email)->get('users')->row_array();

        if(empty($user_info)) return false;

        if($this->db_encrypt_password($password,$user_info['salt']) != $user_info['password']) return false;

        return $user_info;
    }

    public function get_user_directory($uid)
    {
        // get user's folders

    }

    public function get_project_directory($proid)
    {

        // get project's folders

        $folders_result = $this->db->select()->where('proid',$proid)->get('folders')->result_array();

        // get project's pages

        $pages_result = $this->db->select()->where('proid',$proid)->get('pages')->result_array();

        $folder_index = array();

        $directory = array();

        foreach ($folders_result as $index => $folder)
        {
            $new_folder = array(
                'name' => $folder['folderName'],
                'type' => 'folder',
                'parentFid' => $folder['parentFid'],
            );

            $folder_index[$folder['fid']] = $new_folder;
        }

        foreach ($pages_result as $index => $page)
        {
            $new_page = array(
                'name' => $page['title'],
                'type' => 'page',
                'paid' => $page['paid'],
            );

            if((int)$page['parentFid'] !== 0)
            {
                // the page is not a root document
                $folder_index[$page['parentFid']]['project'][] = $new_page;
            }else{
                $directory[] = $new_page;
            }
        }

        foreach ($folder_index as $index=>$folder)
        {
            if((int)$folder['parentFid'] !== 0)
            {
                $folder_index[$folder['parentFid']]['project'][] = $folder;
                unset($folder_index[$index]);
            }
        }

        foreach ($folder_index as $index=>$folder)
        {
            $directory[] = $folder;
        }

        return $this->model_success($directory);

    }

    /**
     * @param $password
     * @param $salt
     * @return string
     */
    public function db_encrypt_password($password, $salt)
    {
        return md5(md5($password) . $salt);
    }

}