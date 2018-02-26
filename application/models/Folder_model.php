<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 7/3/2017
 * Time: 3:43 PM
 */

/**
 * @property folder_model $folder_model
 */
class folder_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function create_folder($data_array)
    {
        $ret = $this->db->insert('folders',$data_array);

        return $this->model_success($ret);
    }

}