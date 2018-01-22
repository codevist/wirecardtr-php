<?php 


include('menu.php');

?>


<form action="" method="post" class="form-horizontal">
<h2>Sale3DURLProxy</h2>
<fieldset>
    <table class="table">
        <thead>
            <tr>
                <th>
                    Ürün Adı
                </th>
                <th>
                    İşlem İçeriği
                </th>
               
                <th>
                    İşlem Tutarı
                </th>
                <th>
                    İşlem Tipi
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Bilgisayar
                </td>
                <td>
                    BLGSYR01
                </td>
                <td>
                   0,01 TL
                </td>
                <td>
                  1 //Tek Çekim
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>

	<fieldset>
		<!-- Button -->
		<div class="form-group">
			<label class="col-md-4 control-label" for=""></label>
			<div class="col-md-4">
				<button type="submit" name="submit" id=""  class="btn btn-success">Ödeme Yap</button>
			</div>
		</div>
	</fieldset>
</form>



<?php if (!empty($_POST)): ?>
<?php
    $settings=new Settings();
	$request = new WDTicketPaymentFormRequest();
	$request->ServiceType = "WDTicket";
    $request->OperationType = "Sale3DSURLProxy";

    $request->Token= new Token();
    $request->Token->UserCode=$settings->UserCode;
    $request->Token->Pin=$settings->Pin;

    $request->Price = 1;
    $request->MPAY = "";
    $request->ErrorURL = "http://localhost:5000/fail.php";
    $request->SuccessURL = "http://localhost:5000/success.php";
    $request->ExtraParam = "";
    $request->PaymentContent = "Bilgisayar";
    $request->Description = "BLGSYR01";
    $request->PaymentTypeId = 1;
    $response = WDTicketPaymentFormRequest::execute($request); // WDTicket3DSecure servisi başlatılması için gerekli servis çağırısını temsil eder.
   
    /**
     * İstek sonucunda oluşan redirect url değerini xml içerisinden ayıklayarak butona ekliyoruz. Eklenen bu değeri tıklayarak response sonucu oluşan url adresine 
     * yönlendirmiş oluyoruz.
     */
    $sxml = new SimpleXMLElement($response);
    $responseUrl=$sxml->Item[3]['Value']; //RedirectUrl adresini bulduğumuz kısım
	print "<h3>Sonuç:</h3>";
	echo "<pre>";
    echo htmlspecialchars ($response);
    echo "</br>";
    echo "</br>";
    echo "<a href='$responseUrl' class='btn btn-danger' >Ödemeyi tamamla</a>"; //Ödemenin tamamlandığı kısım.
    echo "</pre>";
	?>
    <?php endif; ?>

   
<?php include('footer.php');?>