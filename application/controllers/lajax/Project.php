<?php

/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 7/3/2017
 * Time: 2:20 PM
 */
class Project extends Base
{

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function lists()
    {
        $this->check_user();
        $ret = $this->load->view('project/listsView', null, true);
        $this->request_success($ret);
    }
}