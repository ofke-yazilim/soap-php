<!DOCTYPE html>
<!--
Basit mantıkta soap web servis çalışam mantığını içerir.
hem basic authenticate hem de header authenticate içermektedir

örneğin : __getDataSingle fonksiyonunu çağırmak için aşağıdaki xml gönderilir.

<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:soapservice">
    <x:Header>
        <urn:AuthHeader>
            <urn:username>omer</urn:username>
            <urn:password>kesmez</urn:password>
        </urn:AuthHeader>
    </x:Header>
    <x:Body>
        <urn:__getDataSingle>
            <urn:data>omer</urn:data>
        </urn:__getDataSingle>
    </x:Body>
</x:Envelope>
-->

<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
        require_once 'client.php';
        $client = new client();
        
        //Gönderilen değeri ekrana yazar
        echo $client->__getDataSingle(array("data"=>"omer"));
        
        //Gönderilen Array değere uygun olarak array değer döner
        $data = array("data"=>array("limit"=>12,"type"=>"desc"));
        print_r($client->__getDataAll($data));
        
        //Çoklu array gönderiliyor
        $data = array("data"=>array(array("limit"=>12,"type"=>"desc"),array("limit"=>"omer","type"=>"asc"),array("limit"=>345,"type"=>"desc")));
        echo $client->__setDataAll($data);
    ?>
</body>
</html>
