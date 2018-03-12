<?php 

include('menu.php');
?>

<h2> MPAY İle işlem Sorgulama</h2>


<form action="" method="post">
    <!-- Text input-->
    <div class="form-group">
        <div class="row">

            <label class="col-md-12 control-label" for="">MPAY</label>
            <div class="col-md-3">
                <input name="MPay" type="text" value=""  class="form-control" required="">
            </div>
        </div>
        <div class="row">
            <label class="col-md-12 control-label" for=""></label>
            <div class="col-md-4">
                <br />
                <button type="submit" id="" name="" class="btn btn-danger">Sorgula </button>
            </div>
        </div>
       
    </div>
</form>
    
<?php if (!empty($_POST)): ?>
<?php

$context = stream_context_create(array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
));
 /**
     * Setting ayarlarını settings sınıfı içerisinden alıyoruz.
     * Token bilgilerini ve sorgulamak için  gerekli olan orderId  parametresini formdan gelen bilgilerle doldurup, soap servis çağrısını başlatıyoruz.
     * Soap Servis çağrısı sonucunda oluşan servis çıktısını ekrana xml formatında yazdırıyoruz.
     */
$settings=new Settings();
$wsdlUrl = 'https://www.wirecard.com.tr/services/saleservice.asmx?WSDL';
$client = new SoapClient($wsdlUrl, array('stream_context' => $context,'trace' => 1));

$token = new Token();
$token->UserCode =  $settings->UserCode; 
$token->Pin =  $settings->Pin;

$MPay=$_POST["MPay"];
$result = $client->GetSaleResultMPAY (array(
    "token" =>  (array) $token,
    "MPAY" =>   $MPay
));
echo "<pre>";
echo print_r($result);
echo "</pre>";
?>
<?php endif; ?>	  

<?php include('footer.php');?>
