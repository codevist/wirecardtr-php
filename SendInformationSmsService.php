<?php 


include('menu.php');

?>


<h2>Bilgi Sms'i Gönderim Servisi</h2>
<hr/>
<form action="" method="post">

    <div class="row">
        <label class="col-md-12 control-label" for="">SMS Gönderilecek Telefon Numarası:</label>
        <div class="col-md-2">
            <input name="gsm" type="text" id="txtPhoneNumber" value="" class="form-control" placeholder="5XXXXXXXXX" required="">
        </div>
    </div>
    <br/>
    <div class="row">
        <label class="col-md-12 control-label" for="">SMS Metni (Türkçe karakter kullanılmamalı)</label>
        <div class="col-md-2">
            <textarea name="content" rows="8" cols="60"   required=""></textarea>
        </div>
    </div>
    <div class="row">
        <label class="col-md-12 control-label" for=""></label>
        <div class="col-md-4">
            <br />
            <button type="submit" id="" name="" class="btn btn-danger">Bilgi Sms'i Gönder</button>
        </div>
    </div>

</form>

<?php if (!empty($_POST)): ?>
<?php


// options for ssl in php 5.6.5
$context = stream_context_create(array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
));

$settings=new Settings();
$wsdlUrl = 'http://vas.mikro-odeme.com/services/msendsmsservice.asmx?wsdl';
$client = new SoapClient($wsdlUrl, array('stream_context' => $context,'trace' => 1));

$token = new Token();
$token->UserCode =  $settings->UserCode; 
$token->Pin =  $settings->Pin;

$input= new input();
$input->Gsm=$_POST ["gsm"];
$input->Content=$_POST ["content"];
$input->RequestGsmOperator=0;
$input->RequestGsmType=0;

$result = $client->SendSMS( array(
    "token" =>  (array) $token,
    "input" =>  (array) $input
));


echo "<pre>";
echo print_r($result);
echo "</pre>";

?>
    <?php endif; ?>


<?php include('footer.php');?>