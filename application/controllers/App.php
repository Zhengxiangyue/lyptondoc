<?php
/**
 * Created by PhpStorm.
 * User: zhengxiangyue
 * Date: 2/3/2017
 * Time: 11:54 AM
 */

class app extends Base {

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * the entrance of the app
     *
     */
    public function index()
    {
//        $this->load->view('common/header_flatUI');
//        $this->load->view('flat');
        $this->load->view('appView');
    }
}