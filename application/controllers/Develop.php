<?php
/**
 * Created by PhpStorm.
 * User: zhengxiangyue
 * Date: 2/3/2017
 * Time: 11:54 AM
 */

class Develop extends Base {

    public function __construct()
    {
        parent::__construct();
    }

    public function public_encrypt()
    {
        $data = MY_ssl::encrypt($this->input->post('data'));
        echo $data;
        echo MY_ssl::decrypt($data);
    }

    public function redis()
    {
//        MY_Log::log('an error occur',array('adf'=>'adsfefi'));
//        MY_Log::log('真的无语了','info',array('what'=>'is_content??'));
//        Seaslog::info('真的呜呜');
        for($i = 0;$i<1000;++$i)
        {
            MY_Log::log('真的无语了','info',array('what'=>'is_content??'));
//            log_message('info','真的无语了');
        }
    }


    public function create_many_page_tables()
    {
        $result = $this->db->query("CREATE TABLE IF NOT EXISTS `doc_pages_1` (
  `pid` int(11) NOT NULL COMMENT 'page''s id',
  `uid` int(11) NOT NULL COMMENT 'page''s host''s uid',
  `content` text NOT NULL,
  `createTime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        var_dump($result);
    }

    public function socket()
    {
        $this->load->view('socket_front');
    }
}