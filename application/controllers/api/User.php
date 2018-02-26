<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 7/3/2017
 * Time: 2:20 PM
 */

class User extends Base {

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
    }

    /**
     * /?/api/user/login/
     *
     */
    public function login($action = '')
    {
        switch ($action)
        {
            default : $this->common_user_login();
        }
    }

    public function logout($action = '')
    {
        switch ($action)
        {
            default : $this->common_user_logout();
        }
    }

    /**
     * /?/api/user/register/
     * @param string $action
     */
    public function register($action = '')
    {
        switch ($action)
        {
            default : $this->common_user_register();
        }
    }

    /**
     * /?/api/user/info/
     * @param string $action
     */
    public function info($action = '')
    {
        switch ($action)
        {
            default : $this->get_user_info();
        }
    }

    public function directory($action = '')
    {
        switch ($action)
        {
            default : $this->get_user_directory();
        }
    }

    /**
     * /?/api/user/register/
     *
     */
    private function common_user_register()
    {
        $white_list = array(
            'userName',
            'password',
            'email',
        );

        $data_arr = $this->filter_post_data($white_list,true);

        $ret = $this->user_model->common_user_register($data_arr);

        $this->request_success($ret);
    }

    /**
     * /?/api/user/login/
     *
     */
    private function common_user_login()
    {

        // check user status

        $this->check_token();

        if($this->user_id) $this->request_err(null,lang('user_already_login'));

        $white_list = array(
            'email',
            'password'
        );

        $data_arr = $this->filter_post_data($white_list,true);

        $ret = $this->user_model->common_user_login($data_arr);

        $ret['success'] ? $this->request_success($ret['ret'],lang('user_login_success')) : $this->request_err(null,$ret['ret']);
    }

    private function get_user_directory()
    {
        $this->check_user();

        $white_list = array(
            'proid',
        );

        $data_arr = $this->filter_post_data($white_list);

        $ret = $this->user_model->get_project_directory($data_arr['proid']);
        $ret['success'] ? $this->request_success($ret['ret']) : $this->request_err(null,$ret['ret']);
    }

    public function common_user_logout()
    {
        $this->check_user();

        $this->user_model->common_user_logout();

        $this->request_success(null,lang('user_logout_success'));

    }

    /**
     * /?/api/user/info/
     *
     */
    private function get_user_info()
    {
        $this->check_token();

        $user_info = array(
            'uid' => $this->user_id,
            'email' => $this->user_info['email'],
            'userName' => $this->user_info['userName'],
        );

        $this->request_success(array('uid'=>$this->user_id,'userInfo'=>$user_info));
    }

    /**
     *
     */
    public static function see_what_happen()
    {
        echo "something happends";
    }


}