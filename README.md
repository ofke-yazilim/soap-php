# soap-php
Soap Web Servis Php 7.0.23 wamp server
<br>
<a href="mailto:info@ofkeyazilin.com">info@ofkeyazilin.com</a>
<br>
<a target="_blank" href="http://localhost/soap/server.php?wdsl">Ön izleme</a>
<h2>PROJE HAKKINDA</h2>
Proje Netbeans derleyicisi kullanılarak local windows makinası üzerine kurulmuş olan wamp server üzerinde kodlanmıştır. Projede Nusoap kütüphanesi kullanılarak <strong>Soap</strong> web servis işlemleri Php ile gerçekleştirilmiştir.
<br><br>
<strong>Server Makina Üzerinde Çalışması Gereken ve WSDL yapımızın oluşmasını sağlayan Kodlar : </strong> https://github.com/ofke-yazilim/soap-php/blob/master/soap/server.php<br>
<strong>Server Makina Üzerinde Çalışması Gereken ve soap servisimizin çalışmasını sağlayan Kodlar : </strong> https://github.com/ofke-yazilim/soap-php/blob/master/soap/service.php<br>
<strong>Client Makina Üzerinde Çalışması Gereken Kodlar : </strong> https://github.com/ofke-yazilim/soap-php/blob/master/soap/client.php<br>
<strong>Client Makina Üzerinde Client class fonksiyonlarını çağırmak için : </strong> https://github.com/ofke-yazilim/soap-php/blob/master/soap/index.php
<br>
<h2>Gönderilen Bir Xml Örneği</h2>
?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/" xmlns:tns="urn:soapservice">
    <soap:Header>
        <tns:AuthHeader>
            <username xsi:type="xsd:string">omer</username>
            <password xsi:type="xsd:string">kesmez</password>
        </tns:AuthHeader>
    </soap:Header>  
    <soap:Body soap:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
    <tns:__getDataAll>
      <data xsi:type="tns:arrayData">
        <limit xsi:type="xsd:string">1</limit>
        <type xsi:type="xsd:string">1</type>
      </data>
    </tns:__getDataAll>
  </soap:Body>
</soap:Envelope
