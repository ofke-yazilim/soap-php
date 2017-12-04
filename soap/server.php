<?php
/**
 * Soap php server.php
 *
 * @author o.kesmez
 */

require_once "lib/nusoap.php";
$server = new soap_server();
$server->configureWSDL("server", "urn:soapservice");

if(!isset($HTTP_RAW_POST_DATA)){
 $HTTP_RAW_POST_DATA = file_get_contents("php://input");
}

class server {
    public $authenticate = false;
    public function __construct() {
        //Örenğin veritabanı bağlantıları bu kısımda yapılmalıdır.
    }
    
    public function __getDataAll($data=array()) {
        //Eğer kullanıcı giriş bilgileri doğru ise
       if($this->authenticate){
           return $data;
       } else{
           return new soap_fault('-1', 'Kullanıcı Adı ya da Şifre Hatalı.', 'Error !','');
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
            if($_SERVER['PHP_AUTH_USER']=="omer" and $_SERVER['PHP_AUTH_PW']="kesmez" ){
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
}

//Fonksiyona Array veri gönderilecek ise
$server->wsdl->addComplexType(
    'arrayData',
    'complexType',
    'sequence',
    'all',
    '',
    array(
        'limit' => array('name' => 'limit', 'type' => 'xsd:string'),
        'type_' => array('name' => 'type_', 'type' => 'xsd:string')
    )
);

//Fonksiyona Array olarak veri döndürülecek is kullanılır
$server->wsdl->addComplexType("ArrayOfString", 
    "complexType", 
    "array", 
    "", 
    "SOAP-ENC:Array", 
    array(), 
    array(
        array(
            "ref"=>"SOAP-ENC:arrayType",
                "wsdl:arrayType"=>"xsd:string[]"
        )
    )
); 


$server->register("server.__getDataAll",
    array("data" => "tns:arrayData"),
    array("return" => "tns:ArrayOfString"),
    "urn:soapservicea",
    "urn:soapservice#__getDataAll",
    "rpc",
    "encoded",
    "Get All Data");

$server->register("server.__getDataSingle",
    array("data" => "xsd:string"),
    array("return" => "xsd:string"),
    "urn:soapservice",
    "urn:soapservice#__getDataSingle",
    "rpc",
    "encoded",
    "Get All Data");

$server->service($HTTP_RAW_POST_DATA);
