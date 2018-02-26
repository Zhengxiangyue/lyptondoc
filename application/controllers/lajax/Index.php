<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 9/3/2017
 * Time: 9:19 AM
 */

class Index extends Base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $ret = $this->load->view('welcome/welcomeView',null,true);
        $this->request_success($ret);
    }

}