<?php


/**
 * Pazaryeri 3dSecure ve 3D secure olmadan ödeme için gerekli olan alanların tanımlandığı sınıftır.
 * Bu sınıf içerisinde execute metodu ile servis çağrısı başlatılır.
 * Execute metodu içerisinde tanımlanan "toXmlString" metodu gerekli xml metninin oluşturulmasını sağlar.
 * Execute metodu içerisinde tanımlanan url adresine oluşturulan xml post edilir.
 */
class MarketPlaceMpSaleRequest
{
    public  $ServiceType; 
    public  $OperationType; 
    public  $CreditCardInfo; 
    public  $MPAY;
    public  $Token;
    public  $Price;
    public  $ExtraParam; 
    public  $Description;
    public  $IPAddress; 
    public  $Port; 
    public  $ErrorURL; 
    public  $SuccessURL; 
    public  $InstallmentCount; 
    public  $CommissionRate; 
    public  $SubPartnerId; 
    public  $PaymentContent; 
    public  $CardTokenization; 

    public static function Execute(MarketPlaceMpSaleRequest $request)
    {
        return  restHttpCaller::post("https://www.wirecard.com.tr/SGate/Gate" , $request->toXmlString());
    }    
    
    //Post edilmesi istenen xml metni oluşturulup bu xml metni belirtilen adrese post edilir.
    public function toXmlString()
    {
        $xml_data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
        "<WIRECARD>\n" .
        "    <ServiceType>" . $this->ServiceType . "</ServiceType>\n" .
        "    <OperationType>" . $this->OperationType . "</OperationType>\n" .
        "    <Token>\n" .
        "    <UserCode>" .urlencode($this->Token->UserCode) . "</UserCode>\n" .
        "    <Pin>" .urlencode($this->Token->Pin) . "</Pin>\n" .
        "    </Token>\n" .
        "    <CreditCardInfo>\n" .
        "        <CreditCardNo>" . urlencode($this->CreditCardInfo->CreditCardNo) . "</CreditCardNo>\n" .
        "        <OwnerName>" . urlencode($this->CreditCardInfo->OwnerName) . "</OwnerName>\n" .
        "        <ExpireYear>" . urlencode($this->CreditCardInfo->ExpireYear) . "</ExpireYear>\n" .
        "        <ExpireMonth>" . urlencode($this->CreditCardInfo->ExpireMonth) . "</ExpireMonth>\n" .
        "        <Cvv>" . urlencode($this->CreditCardInfo->Cvv) . "</Cvv>\n" .
        "    </CreditCardInfo>\n" .
        "    <CardTokenization>\n" .
        "        <RequestType>" . urlencode($this->CardTokenization->RequestType) . "</RequestType>\n" .
        "        <CustomerId>" . urlencode($this->CardTokenization->CustomerId) . "</CustomerId>\n" .
        "        <ValidityPeriod>" . urlencode($this->CardTokenization->ValidityPeriod) . "</ValidityPeriod>\n" .
        "        <CCTokenId>" . urlencode($this->CardTokenization->CCTokenId) . "</CCTokenId>\n" .
        "    </CardTokenization>\n" .
        "    <MPAY>" . $this->MPAY . "</MPAY>\n" .
        "    <Price>" . $this->Price . "</Price>\n" .
        "    <ExtraParam>" . $this->ExtraParam . "</ExtraParam>\n" .
        "    <Description>" . $this->Description . "</Description>\n" .
        "    <IPAddress>" . $this->IPAddress . "</IPAddress>\n" . 
        "    <Port>" . $this->Port . "</Port>\n" . 
        "    <ErrorURL>" . $this->ErrorURL . "</ErrorURL>\n" . 
        "    <SuccessURL>" . $this->SuccessURL . "</SuccessURL>\n" . 
        "    <InstallmentCount>" . $this->InstallmentCount . "</InstallmentCount>\n" .
        "    <CommissionRate>" . $this->CommissionRate . "</CommissionRate>\n" .
        "    <SubPartnerId>" . $this->SubPartnerId . "</SubPartnerId>\n" .
        "    <PaymentContent>" . $this->PaymentContent . "</PaymentContent>\n" .
        "</WIRECARD>";
         return $xml_data;
       
    }
}