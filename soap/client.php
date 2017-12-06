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
        header('Content-type: text/html; charset=utf-8');
        // wsdl cache 'ini devre disi birak
        ini_set("soap.wsdl_cache_enabled", "0");
        
        //Kullanıcı Adı Ve Şifre belirleniyor Basit authenticate
        //Basic authenticate - Authentication credentials
        $options = array(
            'login'    => "omer",
            'password' => "kesmez",
        );

        // SOAP Client nesnesi olustur
        $this->client = new SoapClient("http://localhost/soap/service.php?wsdl",$options);
        
        $AuthHeader = new stdClass();
        $AuthHeader->username = 'omer';
        $AuthHeader->password = 'kesmez'; 
        $headerParams = new SoapVar($AuthHeader,SOAP_ENC_OBJECT);
        $Headers = new SoapHeader('http://localhost','AuthHeader',$headerParams , false);
        $this->client->__setSoapHeaders($Headers);
    }
    
    public function __getDataAll($data){
        return $this->client->__soapCall("__getDataAll",$data);
    }
    
    public function __getDataSingle($data){
        return $this->client->__soapCall("__getDataSingle",$data);
    }
    
    public function __setDataAll($data){
        return $this->client->__soapCall("__setDataAll",$data);
    }
}