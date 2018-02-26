<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 21/3/2017
 * Time: 11:20 AM
 */

class Communication extends Base
{

    /**
     * folder constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function broadcast($data_arr)
    {
        $this->push(array('type'=>'broadcast','data'=>$data_arr));
    }
}