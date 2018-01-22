<?php include('menu.php');?>

<h2>Deactive Sub Partner</h2>
<fieldset>
    <legend><label style="font-weight:bold;width:250px;">MarketPlace Bilgileri</label></legend>
    <label style="font-weight:bold;">Servis Adı &nbsp; :   &nbsp; </label> CCMarketPlace<br>
    <label style="font-weight:bold;">Operasyon Adı &nbsp; :&nbsp; </label> DeactivateSubPartner <br>
    <label style="font-weight:bold;">UserCode  &nbsp;:  &nbsp;</label> Wirecard tarafından verilen değer <br>
    <label style="font-weight:bold;">Pin &nbsp;:  &nbsp;</label> Wirecard tarafından verilen değer <br>
   
</fieldset>
<br />
<br />
<form action="" method="post" class="form-horizontal">
    <fieldset>
        <!-- Form Name -->
        <legend><label style="font-weight:bold;width:250px;">UniqueId Değeri </label></legend>

      
        <div class="form-group">
            <label class="col-md-4 control-label" for="">UniqueId</label>
            <div class="col-md-4">
                <input name="uniqueId" class="form-control input-md" required="">
            </div>
        </div>
    </fieldset>
  

    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for=""></label>
        <div class="col-md-4">
            <button type="submit" id="" name="" class="btn btn-success">Mağazayı Kapat</button>
        </div>
    </div>
</form>
<?php if (!empty($_POST)): ?>
<?php
    $settings=new Settings();
    $request = new MarketPlaceDeactiveRequest();
    $request->ServiceType = "CCMarketPlace";
    
    $request->Token= new Token();
    $request->Token->UserCode=$settings->UserCode;
    $request->Token->Pin=$settings->Pin;
    
    $request->OperationType = "DeactivateSubPartner";
    $request->UniqueId = $_POST["uniqueId"];
    $response = MarketPlaceDeactiveRequest::execute($request); // Market Place Silme servisinin başlatılması için gerekli servis çağırısını temsil eder.
    print "<h3>Sonuç:</h3>";
	echo "<pre>";
    echo htmlspecialchars ($response);  
    echo "</pre>";
	?>

<?php endif; ?>	 
<?php include('footer.php');?>

