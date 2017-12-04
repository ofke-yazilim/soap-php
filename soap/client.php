<?php
/*
 * Client fonksiyonları içerir
 */

/**
 * Description of client
 *
 * @author o.kesmez
 */
class client {
    private $client;
    private $error;
    public function __construct(){
        require_once "lib/nusoap.php";
        $this->client = new nusoap_client("http://localhost/soap/server.php?wsdl", true);
        $this->client->soap_defencoding = 'UTF-8';
        $this->client->decode_utf8 = false;
        //Kullanıcı adı şifre giriliyor.
        $this->client->setCredentials("omer","kesmez", 'basic');
        $this->error  = $this->client->getError();
    }
    
    public function __getDataAll($data){
        return $this->client->call("server.__getDataAll",$data);
    }
    
    
    public function __getDataSingle($data){
        return $this->client->call("server.__getDataSingle",$data);
    }
}
