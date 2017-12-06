<?php

/*
 * Soap servisin çalıştırdığı fonksiyonları içeririr
 */

/**
 * Description of servernew
 *
 * @author o.kesmez
 */
class service {
    public $authenticate = false;
    public function __construct() {
        //Örenğin veritabanı bağlantıları bu kısımda yapılmalıdır.
        self::authenticate();
    }
    
    public function __getDataAll($data=array()) {
        //Eğer kullanıcı giriş bilgileri doğru ise
        if($this->authenticate){ 
            $_data[] = array("limit" => $data->limit,"type" => $data->type);
            return $_data;
        } else{
            $_data[] = array("limit"=>"Kullanıcı Adı ya da şifre hatalı.","type"=>"");
//            return new soap_fault('-1', 'Kullanıcı Adı ya da Şifre Hatalı.', 'Error !','');
            return $_data;
        }
        
    }
    
    public function __setDataAll($data=array()) {
        //Eğer kullanıcı giriş bilgileri doğru ise
        if($this->authenticate){ 
            $_data = "";
            foreach ($data as $key => $value) {
                $_data .= $value->limit."-".$value->type;
            }
            return $_data;
        } else{
            return "Kullanıcı Adı ya da şifre hatalı.";
        }
    }
    
    public function __getDataSingle($data) {
       //Eğer kullanıcı giriş bilgileri doğru ise
       if($this->authenticate){
           return $data;
       } else{
           return "Kullanıcı Adı Ya da şifre hatalı.";
       }
    }
    
    //Login kontrol yapılıyor
    function doAuthenticate(){    
        if(isset($_SERVER['PHP_AUTH_USER']) and isset($_SERVER['PHP_AUTH_PW']) )
        {
            //Kullanıcı adı omer ve password kesmez ise 
            if($_SERVER['PHP_AUTH_USER']=="omer" && $_SERVER['PHP_AUTH_PW']=="kesmez" ){
                return true;
            } else{
                return  false;   
            }                
        }
    }
    
    //Eğer kullanıcı girişi yapıldı ise
    function authenticate() {
        if(self::doAuthenticate()){
            $this->authenticate = true;
        } else{
            $this->authenticate = false;
        }
    }
    
    //Header authenticate
    public function AuthHeader($login)
    {
        if(!empty($login->username) && !empty($login->password)) {
            if($login->username == "omer" && $login->password== "kesmez") {  
                $this->authenticate = true;   
            } else {
                $this->authenticate = false;
//                die("Header Kullanıcı adı ya da password hatası.");
//                throw new SOAPFault("Header Kullanıcı adı ya da password hatası.", 401);  
            }
        } else {
            $this->authenticate = false;
//            die("Header kullanıcı adı ya da password girilmedi.");
//            throw new SOAPFault("Header kullanıcı adı ya da password girilmedi.", 401);
        } 
    }
 
    
}

// wsdl cache 'ini devre disi birak
ini_set("soap.wsdl_cache_enabled", "0");

// Soap Server nesnesi olustur
$soapServer = new SoapServer("http://localhost/soap/server.php?wsdl", array('encoding' => 'UTF-8'));

// Soap Server 'a server sinifini kullanmasini soyle
$soapServer->setClass("service");

$header =  new SoapHeader('http://localhost','AuthHeader');
$soapServer->addSoapHeader($header);

// Soap Server 'i baslat ve gelen istekleri server sinifina gonder
$soapServer->handle();
