
<?php 

include('menu.php');
?>

<h2> Abonelik Listeleme</h2>
<hr />
<link href="../Assets/css/jquery-ui.css" rel="stylesheet" />

<form action="" method="post">

    <!-- Text input-->
    <div class="form-group">
        <div class="row">

            <label class="col-md-12 control-label" for="">Telefon Numarası</label>
            <div class="col-md-3">
                <input name="gsmNumber" type="text" value="" id="txtPhoneNumber" class="form-control" placeholder="(5XX)XXXXXXX" required="">
            </div>
        </div>

        <div class="row">
            <br />
            <label class="col-md-12 control-label" for=""> Ödeme Yöntemi:</label>
            <div class="col-md-12">
                <select name="subscriberTypeId">
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
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-2">
                <label class="col-md-12 control-label" for="">Abonelik Satış Kanalı</label>
                <div class="col-md-12">
                    <select name="orderChannelId">
                        <option value="100">Pro Api</option>
                        <option value="101">Basic Api</option>
                        <option value="102">Sms</option>
                        <option value="103">Direct Api</option>
                        <option value="104">Api Plus</option>

                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label class="col-md-12 control-label" for="">Abonelik Aktif/Pasif Bilgisi</label>
                <div class="col-md-12">
                    <select name="activeTypeId">
                        <option value="1">Aktif</option>
                        <option value="0">Pasif</option>
                        <option value="-1">Hepsi</option>

                    </select>
                </div>
            </div>

        </div>
        <br />
        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-2">Abonelik Başlangıç Tar.</label>
                <div class="col-md-3">
                <input name="startDateMin" type="text" value="" id="txtStartDateMin" class="form-control"  @readonly = "readonly", required="">
                    <span class="help-block">
                        Abonelik başlangıç tarihini belirtir (alt sınır)
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-2">Abonelik Başlangıç Tar.</label>
                <div class="col-md-3">
                 
                    <input name="startDateMax" type="text" value="" id="txtStartDateMax" class="form-control"  @readonly = "readonly", required="">
                    <span class="help-block">
                        Abonelik başlangıç tarihini belirtir (üst sınır)
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-2">Son Başarılı Ödeme Tarihi</label>
                <div class="col-md-3">
                <input name="lastSuccessfulPaymentDateMin" type="text" value="" id="txtLastSuccessfulPaymentDateMin" class="form-control"  @readonly = "readonly", required="">
                    <span class="help-block">
                        Aboneliğe ait son başarılı ödeme tarihini belirtir. (alt sınır)
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="control-label col-md-2">Son Başarılı Ödeme Tarihi</label>
                <div class="col-md-3">
                <input name="lastSuccessfulPaymentDateMax" type="text" value="" id="txtLastSuccessfulPaymentDateMax" class="form-control"  @readonly = "readonly", required="">
                    <span class="help-block">
                        Aboneliğe ait son başarılı ödeme tarihini belirtir. (üst sınır)
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-md-12 control-label" for=""></label>
            <div class="col-md-4">
                <br />
                <button type="submit" id="" name="" class="btn btn-danger">Abonelik Listele</button>
            </div>
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

 /**
     * Setting ayarlarını settings sınıfı içerisinden alıyoruz.
     * Token bilgilerini ve input alanlarını formdan gelen bilgilerle doldurup, soap servis çağrısını başlatıyoruz.
     * Saop Servis çağrısı sonucunda oluşan servis çıktısını ekrana xml formatında yazdırıyoruz.
     */
$settings=new Settings();
$wsdlUrl = 'https://www.wirecard.com.tr/services/SubscriberManagementService.asmx?wsdl';
$client = new SoapClient($wsdlUrl, array('stream_context' => $context,'trace' => 1));


$token = new Token();
$token->UserCode =  $settings->UserCode; 
$token->Pin =  $settings->Pin;

$input= new input();
$input->ProductId=0;
$input->GSM=$_POST["gsmNumber"];
$input->OrderChannelId=$_POST["orderChannelId"];
$input->Active=$_POST["activeTypeId"];
$input->SubscriberType=$_POST["subscriberTypeId"];
$input->StartDateMin=date('c',strtotime($_POST["startDateMin"]));
$input->StartDateMax=date('c',strtotime($_POST["startDateMax"])); 
$input->LastSuccessfulPaymentDateMin=date('c',strtotime($_POST["lastSuccessfulPaymentDateMin"]));
$input->LastSuccessfulPaymentDateMax=date('c',strtotime($_POST["lastSuccessfulPaymentDateMax"]));

$result = $client->SelectSubscriber(array(
    "token" =>  (array) $token,
    "input" =>  (array) $input
));

echo "<pre>";
echo print_r($result);
echo "</pre>";

?>
<?php endif; ?>	  

<?php include('footer.php');?>

    <script src="../Assets/js/jquery-ui.js"></script>
    <script src="../Assets/js/jquery.maskedinput.min.js"></script>
    <script src="../Assets/js/datepicker-tr.js"></script>
    <script>
        $("#txtPhoneNumber").mask("9999999999", { placeholder: "__________" });


        $("#txtStartDateMin").datepicker({
            dateFormat: 'dd.mm.yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-3:+1",
            onSelect: function (selected) {
                $("#txtStartDateMax").datepicker("option", "minDate", selected);
            }
        });
        $("#txtStartDateMax").datepicker({
            dateFormat: 'dd.mm.yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-3:+1",
            onSelect: function (selected) {
                $("#txtStartDateMin").datepicker("option", "maxDate", selected);
            }
        });
        $("#txtLastSuccessfulPaymentDateMin").datepicker({
            dateFormat: 'dd.mm.yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-3:+1",
            onSelect: function (selected) {
                $("#txtLastSuccessfulPaymentDateMax").datepicker("option", "minDate", selected);
            }
        });
        $("#txtLastSuccessfulPaymentDateMax").datepicker({
            dateFormat: 'dd.mm.yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-3:+1",
            onSelect: function (selected) {
                $("#txtLastSuccessfulPaymentDateMin").datepicker("option", "maxDate", selected);
            }
        });
    </script>