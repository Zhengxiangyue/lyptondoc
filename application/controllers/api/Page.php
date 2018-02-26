<?php

/**
 * Class page
 * @property page_model $page_model
 */
class page extends Base {

    /**
     * page constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('page_model');
    }

    /**
     * this is a test method for creating page
     *
     */
    public function create()
    {
        $white_list = array(
            'proid',
            'content',
            'htmlContent',
            'title',
        );

        $data_arr = $this->filter_post_data($white_list,true);

        $insert_result = $this->page_model->create_page($data_arr);

        $this->load->model('user_model');

        $ret = $this->user_model->get_project_directory($data_arr['proid']);

        $ret['success'] ? $this->request_success(array('directory'=>$ret['ret'],'paid'=>$insert_result['ret'])) : $this->request_err($ret['ret']);
    }

    /**
     * /?/api/page/update
     *
     */
    public function update()
    {
        $white_list = array(
            'paid',
            'title',
            'htmlContent',
        );
        $data_arr = $this->filter_post_data($white_list);

        $update = $this->page_model->db->update('pages',
            array(
                'htmlContent'=>$data_arr['htmlContent'],
                'title' => $data_arr['title'],
            ),
            array('paid'=>$data_arr['paid'])
        );

        if(!$update) $this->request_err(array('update'=>$update),'更新失败');

        $this->request_success(array('update'=>$update),'更新成功');


    }

    /**
     *
     */
    public function get()
    {

        $this->check_user();

        $result = $this->db->select()->where("paid", $_POST['paid'])->get('pages')->row_array();

        $this->request_success(array('title'=>$result['title'],'html'=>htmlspecialchars_decode($result['htmlContent'])));
    }


}