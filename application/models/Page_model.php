<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 7/3/2017
 * Time: 3:43 PM
 */

/**
 * @property page_model $page_model
 */
class page_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return CI_Benchmark
     */
    public function create_page($data_array)
    {
        $ret = $this->db->insert('pages',$data_array);

        $id = $this->db->insert_id();

        return $this->model_success($id);
    }

}