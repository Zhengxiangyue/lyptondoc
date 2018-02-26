<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 7/3/2017
 * Time: 2:21 PM
 */

class Project extends Base {

    /**
     * Project constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $action
     */
    public function create($action = '')
    {
        switch ($action)
        {
            default : $this->create_project();
        }
    }

    /**
     * @param string $action
     */
    public function get($action = '')
    {
        switch ($action)
        {
            default : $this->get_user_project_list();
        }
    }

    public function discard($action = ''){
        switch ($action)
        {
            default : $this->discard_project();
        }
    }

    /**
     * /?/api/project/create/
     *
     */
    private function create_project()
    {

        $this->check_user();

        $white_list = array(
            'projectName',
            'privacy',
        );

        $data_arr = $this->filter_post_data($white_list,true);

        $result = $this->db->insert('projects',array('uid'=>$this->user_id,'projectName'=>$data_arr['projectName'],'privacy'=>$data_arr['privacy']));

        $result ? $this->get_user_project_list() : $this->request_err(null,'网络错误，请稍后再试');
    }

    /**
     * /?/api/project/get/
     *
     */
    private function get_user_project_list($status = '')
    {
        $this->check_user();

        if (!$status){
            $result = $this->db->select()->where('uid',$this->user_id)
                ->where('status',0)
                ->get('projects')->result_array();
        }

        $this->request_success($result);
    }

    /**
     * /?/api/project/discard/
     *
     */
    private function discard_project()
    {
        $this->check_user();

        $data_arr = $this->filter_post_data(array('proid'));

        $result = $this->db->update('projects',array('status'=>'-1'),array('uid'=>$this->user_id,'proid'=>$data_arr['proid']));

        $result ? $this->get_user_project_list() : $this->request_err(null,'你不能删除这个项目');
    }

}