<?php 

include('menu.php');
?>

<h2> Abonelik Detayları</h2>


<form action="" method="post">
    <!-- Text input-->
    <div class="form-group">
        <div class="row">

            <label class="col-md-12 control-label" for="">Abonelik Numarası</label>
            <div class="col-md-3">
                <input name="subscriberId" type="text" value=""  class="form-control" required="">
            </div>
        </div>
        <div class="row">
            <label class="col-md-12 control-label" for=""></label>
            <div class="col-md-4">
                <br />
                <button type="submit" id="" name="" class="btn btn-danger">Aboneliği İptal Et </button>
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

$settings=new Settings();
$wsdlUrl = 'https://www.wirecard.com.tr/services/SubscriberManagementService.asmx?wsdl';
$client = new SoapClient($wsdlUrl, array('stream_context' => $context,'trace' => 1));

$token = new Token();
$token->UserCode =  $settings->UserCode; 
$token->Pin =  $settings->Pin;

$subscriberId=$_POST["subscriberId"];
$result = $client->DeactivateSubscriber (array(
    "token" =>  (array) $token,
    "subscriberId" =>   $subscriberId
));
echo "<pre>";
echo print_r($result);
echo "</pre>";
?>
<?php endif; ?>	  

<?php include('footer.php');?>
