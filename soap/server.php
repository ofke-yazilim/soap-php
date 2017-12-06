<?php
/**
 * Soap php server.php
 * wsdl dosyası oluşturulur
 * @author o.kesmez
 */

header ('Content-type: text/html; charset=utf-8');

// wsdl cache 'ini devre disi birak
ini_set("soap.wsdl_cache_enabled", "0");

require_once "lib/nusoap.php";
$server = new soap_server();
$server->configureWSDL(
        "server", //Servisimizin adı
        "urn:soapservice" , //Namespace belirleniyor
        "http://localhost/soap/service.php"//Servis adresimiz servisimizin çalışacağı adres
    );

//Fonksiyona Array veri gönderilecek ise
$server->wsdl->addComplexType(
    'arrayData',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'limit' => array('name' => 'limit', 'type' => 'xsd:string'),
        'type'  => array('name' => 'type', 'type' => 'xsd:string')
    )
);

//Fonksiyona Array veri gönderilecek ise
$server->wsdl->addComplexType(
    'arrayAuth',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'username' => array('name' => 'username', 'type' => 'xsd:string'),
        'password'  => array('name' => 'password', 'type' => 'xsd:string')
    )
);

// ArrayList tipi tanimla
$server->wsdl->addComplexType(
    'ArrayList', // ozel tip adi
    'complexType', // tip
    'struct', // compositor struct=>json formatıda veriyi temsil eder sequence=>array değerinde veriyi temsil eder
    'all', // restrictionBase
    '', // elements
    array(
        'arrayData' => array(
            'name'  => 'arrayData',
            'type'  => 'tns:arrayData',
            'minOccurs' => '0',
            'maxOccurs' => 'unbounded'
        )
    )
);

//Çoklu array göndermeyi sağlar
$server->wsdl->addComplexType(
  'MultiArray',
  'complexType',
  'array',
  '',
  'SOAP-ENC:Array',
  array(),
    array(
      array('ref' => 'SOAP-ENC:arrayType',
           'wsdl:arrayType' => 'tns:arrayData[]')
    ),
  'tns:arrayData'
);

$server->register("__getDataAll",
    array("data" => "tns:arrayData"),
    array("return" => "tns:ArrayList"),
    "urn:soapservice",
    "urn:soapservice#__getDataAll",
    "rpc",
    "encoded",
    "Get All Data");

$server->register("__setDataAll",
    array("data" => "tns:MultiArray"),
    array("return" => "xsd:string"),
    "urn:soapservice",
    "urn:soapservice#__setDataAll",
    "rpc",
    "encoded",
    "Get All Data");

$server->register("__getDataSingle",
    array("data" => "xsd:string"),
    array("return" => "xsd:string"),
    "urn:soapservice",
    "urn:soapservice#__getDataSingle",
    "rpc",
    "encoded",
    "Get All Data");

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);