<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 8/2/2017
 * Time: 1:39 PM
 */

class MY_qqmail{

    private $host = "";
    private $_cookieJar1;
    private $_cookieJar2;
    private function init($username){
        $this->_cookieJar1 = MAIL_ROOT.'/temp/'.substr($username, 0,3).'_'.time().'_1';
        $this->_cookieJar2 = MAIL_ROOT.'/temp/'.substr($username, 0,3).'_'.time().'_2';
    }
    private function checklogin1( $user, $password ){
        if ( empty( $user ) || empty( $password ) ){
            return 0;
        }
        $ch = curl_init( );
        curl_setopt( $ch, CURLOPT_URL, "http://w.mail.qq.com/cgi-bin/loginpage?f=xhtml" );
        curl_setopt( $ch, CURLOPT_HEADER,   1);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER,   1);
        curl_setopt( $ch, CURLOPT_COOKIEJAR, $this->_cookieJar1);
        curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']  );
        curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);
        $contents = curl_exec( $ch );
        curl_close( $ch );
        if ( !preg_match( "/ssl_edition=(.*)\; Domain/", $contents, $matches))
        {
            return 0;
        }
        $this->host = $matches[1];
        return 1;
    }
    //
    private function checkLogin2($user, $password ){
        if ( empty( $user ) || empty( $password ) ){
            return 0;
        }
        $bRet = $this->readcookies( $this->_cookieJar1 );
        $headers_login = array(
            'Accept:image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/msword, */*',
            'Accept-Encoding:gzip, deflate',
            'Accept-Language:zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3',
            'Cache-Control:no-cache',
            'Connection:Keep-Alive',
            'Content-Length:320',
            'Content-Type:application/x-www-form-urlencoded',
            'Cookie:device=; edition='.$bRet['edition'].'; ssl_edition='.$bRet['ssl_edition'].'; mcookie='.$bRet['mcookie'],
            'Host:'. $bRet['edition'],
            'Referer:http://w.mail.qq.com/cgi-bin/loginpage?f=xhtml',
            'User-Agent:Mozilla/5.0 (Windows NT 5.1; rv:16.0) Gecko/20100101 Firefox/16.0',
        );
        $post = array(
            'action'=>'',
            'aliastype' =>	'@qq.com',
            'btlogin' => '登录', //登陆按钮
            'delegate_url' => '',
            'device' =>'',
            'f'	=> 'xhtml',
            'mss' => '1', //记住登陆状态
            'p' =>	'',
            'pwd'=> $password,
            'tfcont'=>'',
            'ts'=>time(), //当前时间
            'uin' =>$user,
        );
        $ch = curl_init();
        var_dump(curl_setopt( $ch, CURLOPT_URL, "http://w35.mail.qq.com/cgi-bin/login?sid=" ));
        var_dump(curl_setopt($ch, CURLOPT_POSTFIELDS, $post));
        var_dump(curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_login));
        var_dump(curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']  ));
        var_dump(curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT));
        var_dump(curl_setopt( $ch, CURLOPT_RETURNTRANSFER,   1));
        var_dump(curl_setopt($ch, CURLOPT_HEADER, 0));
        var_dump(curl_setopt( $ch, CURLOPT_COOKIEFILE, $this->_cookieJar1 ));
        var_dump(curl_setopt( $ch, CURLOPT_COOKIEJAR, $this->_cookieJar2 ));

        $contents = curl_exec($ch);
        $erron = curl_errno($ch);
        $error = curl_error($ch);
        curl_close( $ch );
        var_dump($erron,$error);
        file_put_contents($this->_cookieJar1.'.text', $contents);
        return 1;
    }
    public function getAddressList( $user, $password){
        $this->init($user);
        if ( !$this->checklogin1( $user, $password ) ){
            return 0;
        }

        if ( !$this->checklogin2( $user, $password ) ){
            return 0;
        }exit;
        $cookies = array( );
        $bRet = $this->readcookies( $this->_cookieJar1 );

        if ( !$bRet){
            return 0;
        }
        $ch = curl_init( );
        curl_setopt( $ch, CURLOPT_COOKIESESSION, true);
        curl_setopt( $ch, CURLOPT_REFERER, "http://w.mail.qq.com/cgi-bin/loginpage?f=xhtml" );
        curl_setopt( $ch, CURLOPT_COOKIEFILE, $this->_cookieJar1 );
        curl_setopt( $ch, CURLOPT_COOKIEJAR, $this->_cookieJar1 );
        curl_setopt( $ch, CURLOPT_HEADER,   1);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_TIMEOUT, TIMEOUT );
        curl_setopt( $ch, CURLOPT_POST, true );
        //curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
        curl_setopt( $ch, CURLOPT_URL, "http://".$this->host."/cgi-bin/login");
        curl_setopt( $ch, CURLOPT_POSTFIELDS, "device=&f=xhtml&tfcont=&uin=".$user."&aliastype=@qq.com&pwd=".$password."&btlogin=登录&mss=" );
        curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );
        $contents = curl_exec( $ch );

        file_put_contents('QQ.txt', $contents);
        //preg_match('/today\?sid\=(.*)&t\=today/i', $contents, $matches);
        preg_match('/today\?sid\=(.*)&/i', $contents, $matches);
        echo (htmlspecialchars($contents));
        if(empty($matches[1])){
            return 0;
        }
        $sid = $matches[1];
        $ch = curl_init( );
        curl_setopt( $ch, CURLOPT_COOKIESESSION, true);
        curl_setopt( $ch, CURLOPT_COOKIEFILE, $this->_cookieJar1 );
        curl_setopt( $ch, CURLOPT_COOKIEJAR, $this->_cookieJar1 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, TIMEOUT );
        curl_setopt( $ch, CURLOPT_USERAGENT, USERAGENT );
        curl_setopt( $ch, CURLOPT_URL, "http://".$this->host."/cgi-bin/addr_listall?sid=".$sid."&flag=star&s=search&folderid=all&pagesize=10&from=today&fun=slock&page=0&topmails=0&t=addr_listall&loc=today,,,158" );
        $content = curl_exec( $ch );
        curl_close( $ch );
        file_put_contents('QQresult.txt', $content);
        /*$bRet = $this->_parsedata( $content, $result );
        if ( !$bRet )
        {
            return 0;
        }*/
        return 1;
    }

    function _parsedata( $content, &$ar )
    {
        $ar = array( );
        if ( !$content )
        {
            return 0;
        }
        $data = json_decode( $content );
        unset( $content );
        foreach ( $data->data->contact as $value )
        {
            if ( preg_match_all( "/[a-z0-9_\\.\\-]+@[a-z0-9\\-]+\\.[a-z]{2,6}/i", $value->email, $matches ) )
            {
                $emails = array_unique( $matches[0] );
                unset( $matches );
                foreach ( $emails as $email )
                {
                    $ar[$email] = $value->name;
                }
            }
        }
        return 1;
    }
    function readcookies( $file )
    {
        $fp = fopen( $file, "r" );
        while ( !feof( $fp ) ){
            $buffer = fgets( $fp, 4096 );
            $tmp = preg_split("/\t/", $buffer );
            if(isset($tmp[6])){
                $result[trim( $tmp[5] )] = trim( $tmp[6] );
            }
        }
        return $result;
    }

}