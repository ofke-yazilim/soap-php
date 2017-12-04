<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
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
        $data = array("data"=>array("limit"=>"deneme","type_"=>"desc"));
        var_dump($client->__getDataAll($data));
    ?>
</body>
</html>
