<?php include('menu.php');?>
<fieldset>
    <legend><label style="font-weight:bold;width:250px;">Release Payment </label></legend>
    <label style="font-weight:bold;">Servis Adı &nbsp; :   &nbsp; </label> CCMarketPlace<br>
    <label style="font-weight:bold;">Operasyon Adı &nbsp; :&nbsp; </label> ReleasePayment <br>
    <label style="font-weight:bold;">UserCode  &nbsp;:  &nbsp;</label> Wirecard tarafından verilen değer <br>
    <label style="font-weight:bold;">Pin &nbsp;:  &nbsp;</label> Wirecard tarafından verilen değer <br>
    <label style="font-weight:bold;">Komisyon Oranı &nbsp;:  &nbsp;</label> 100 //1*100 komisyon oranı 100 ile çarpılarak gönderilir. <br>
    <label style="font-weight:bold;">MPAY &nbsp;:  &nbsp;</label> Ödeme esnasında gönderilen MPay değeri eklenmelidir. <br>
    <label style="font-weight:bold;">OrderId &nbsp;:  &nbsp;</label> Ödemenin Benzersiz Id değeri <br>
    <label style="font-weight:bold;">Açıklama &nbsp;:  &nbsp;</label> Bilgisayar Ödemesi <br>
   
</fieldset>

<br />
<br />
<form action="" method="post" class="form-horizontal">
    <fieldset>
        <!-- Form Name -->
        <legend><label style="font-weight:bold;width:250px;">SubPartner Bilgileri</label></legend>
        <!-- Text input-->   
        <div class="form-group">
            <label class="col-md-4 control-label" for="">  SubPartnerId: </label>
            <div class="col-md-4">
                <input value="" name="subPartnerId" class="form-control input-md">
            </div>
        </div>

    </fieldset>
    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for=""></label>
        <div class="col-md-4">
            <button type="submit" id="" name="" class="btn btn-danger"> Ödeme Onayı Ver</button>
        </div>
    </div>
</form>

<?php if (!empty($_POST)): ?>
<?php
    /**
     * Setting ayarlarını settings sınıfı içerisinden alıyoruz.
     * Token bilgilerini ve Üye işyeri ödeme onayı  için  gerekli olan MarketPlaceSaleReleasePaymentRequest sınıfını formdan gelen bilgilerle doldurup, xml servis çağrısını başlatıyoruz.
     * Xml Servis çağrısı sonucunda oluşan servis çıktısını ekrana xml formatında yazdırıyoruz.
     */
     $settings=new Settings();

     $request = new MarketPlaceSaleReleasePaymentRequest();
     $request->ServiceType = "CCMarketPlace";
     $request->OperationType = "ReleasePayment";

     $request->Token= new Token();
    $request->Token->UserCode=$settings->UserCode;
    $request->Token->Pin=$settings->Pin;
    
     $request->MPAY = "";
     $request->CommissionRate = 100;//%1
     $request->SubPartnerId = $_POST["subPartnerId"];
     $request->Description = "Odeme Onaylandı";
     $request->OrderId = Helper::Guid ();
 
     $response = MarketPlaceSaleReleasePaymentRequest::execute($request); // Market Place 3D Secure servisi başlatılması için gerekli servis çağırısını temsil eder.
     print "<h3>Sonuç:</h3>";
     echo "<pre>";
     echo htmlspecialchars ($response);  
     echo "</pre>";
  
	?>

<?php endif; ?>

<?php include('footer.php');?>