<?php 

include('menu.php');
?>

<h2>Api Plus Yöntemi İle Ödeme </h2>
<form action="" method="post">
    <table class="table">
        <thead>
            <tr>
                <th>
                    Ürün Id
                </th>
                <th>
                    Ürün Açıklaması
                </th>
                <th>
                    Birim Fiyat
                </th>
                <th>
                    Unit
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    0
                </td>
                <td>
                    Telefon
                </td>
                <td>
                    0.01 TL
                </td>
                <td>
                    1
                </td>
            </tr>

        </tbody>
    </table>
    <hr />

    <div class="row">
        <label class="col-md-12 control-label" for="">Telefon Numarası</label>
        <div class="col-md-3">
            <input name="gsmNumber" type="text" value="" id="txtPhoneNumber" class="form-control" placeholder="(5XX)XXXXXXX" required="">
        </div>
    </div>
    <br />
    Ödeme Yöntemi:
    <br />
    <select name="paymentTypeId">
        <option value="1">Tek Çekim</option>
        <option value="2">Aylık abonelik (iletilen miktar her ay otomatik çekilir)</option>
        <option value="3">Haftalık abonelik (iletilen miktar her hafta otomatik çekilir)</option>
        <option value="4">2 haftalık abonelik</option>
        <option value="5">3 aylık abonelik</option>
        <option value="6">6 aylık abonelik</option>
        <option value="7">Aylık denemeli (ilk ay ücretlendirme yapılmaz)</option>
        <option value="8">Haftalık denemeli (ilk hafta ücretlendirme yapılmaz)</option>
        <option value="9">2 haftalık denemeli (ilk 2 hafta ücretlendirme yapılmaz)</option>
        <option value="10">3 aylık denemeli</option>
        <option value="11">6 aylık denemeli</option>
        <option value="13">30 günlük</option>
        <option value="14">Günlük abonelik</option>
    </select>
    <br />
    <br />

    Ürün Kategorisi:
    <br />
    <select name="productCategoryId">
        <option value="1">Fiziksel Ürün</option>
        <option value="2">Oyun</option>
        <option value="3">Dijital İçerik</option>
        <option value="4">Servis </option>
        <option value="5">Sosyal Ağ/Arkadaşlık </option>
        <option value="6">Aidat/Otomat </option>
        <option value="7">Bahis </option>
        <option value="8">Sigorta </option>
        <option value="10">Kamu - bilet - fastfood </option>
        <option value="11">Cep Sigorta </option>
        <option value="12">Kutu Oyun </option>
        <option value="14">Mobil Uygulama / Mobil Market </option>
        <option value="15">Eğitim </option>
        <option value="16">Bağış (sadece Turkcell aboneleri bağış ödemesi yapabilir) </option>
        <option value="19">Sağlık </option>
        <option value="20">White Label Adult </option>

    </select>
    <br />
    <br />
    <button type="submit" id="" name="" class="btn btn-danger">Sms İle Ödeme Yap</button>
    <br/>
    <br/>
   
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
$wsdlUrl = 'https://www.wirecard.com.tr/services/saleservice.asmx?wsdl';
$client = new SoapClient($wsdlUrl, array('stream_context' => $context,'trace' => 1));


$token = new Token();
$token->UserCode =  $settings->UserCode; 
$token->Pin =  $settings->Pin;

$product = new Product();
$product->ProductId=0;
$product->ProductCategory=$_POST["productCategoryId"];
$product->ProductDescription="Telefon";
$product->Price=0.01;
$product->Unit=1;


$input= new input();
$input->MPAY="";
$input->Gsm =$_POST["gsmNumber"];
$input->Content ="TLFN01-Telefon";
$input->SendOrderResult=true;
$input->PaymentTypeId=$_POST["paymentTypeId"];
$input->ReceivedSMSObjectId="00000000-0000-0000-0000-000000000000";
$input->ProductList=array($product);
$input->SendNotificationSMS=true;
$input->OnSuccessfulSMS="basarili odeme yaptiniz";
$input->OnErrorSMS="basarisiz odeme yaptiniz";
$input->Url=helper::getCurrentUrl();
$input->RequestGsmOperator=0;
$input->RequestGsmType=0;
$input->Extra="";
$input->TurkcellServiceId="20923735";

$result = $client-> SaleWithConfirm( array(
    "token" =>  (array) $token,
    "input" =>  (array) $input
));


echo "<pre>";
echo print_r($result);
echo "</pre>";

?>
<?php endif; ?>
	

<?php include('footer.php');?>

<script src="../Assets/js/jquery.maskedinput.min.js"></script>
<script>
        $("#txtPhoneNumber").mask("9999999999", { placeholder: "__________" });
</script>