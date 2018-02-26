<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 7/3/2017
 * Time: 2:21 PM
 */

class folder extends Base {

    /**
     * folder constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('folder_model');
    }

    /**
     * @param string $action
     */
    public function create($action = '')
    {
        switch ($action)
        {
            default : $this->create_folder();
        }
    }

    /**
     * /?/api/folder/create
     */
    private function create_folder()
    {

        $this->check_user();

        $white_list = array(
            'pid',
            'parentFid',
            'folderName',
        );

        $data_arr = $this->filter_post_data($white_list,true);

        $data_arr['uid'] = $this->user_id;

        $ret = $this->folder_model->create_folder($data_arr);

    }

}