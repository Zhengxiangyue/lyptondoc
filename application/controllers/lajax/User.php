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
    }

    /**
     * lajax login view
     */
    public function login()
    {
        $ret = $this->load->view('user/loginView',null,true);
        $this->request_success($ret);
    }

    /**
     * lajax register view
     */
    public function register()
    {
        $ret = $this->load->view('user/registerView',null,true);
        $this->request_success($ret);
    }

}