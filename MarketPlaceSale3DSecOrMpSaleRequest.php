<?php

class MarketPlaceSale3DOrMpSaleRequest
{
    public  $ServiceType; 
    public  $OperationType; 
    public  $CreditCardInfo; 
    public  $MPAY;
    public  $Token;
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
    public  $CCTokenId; 
    public static function Execute(MarketPlaceSale3DOrMpSaleRequest $request)
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
        "        <Price>" . urlencode($this->CreditCardInfo->Price) . "</Price>\n" .
        "    </CreditCardInfo>\n" .
        "    <MPAY>" . $this->MPAY . "</MPAY>\n" .
        "    <ExtraParam>" . $this->ExtraParam . "</ExtraParam>\n" .
        "    <Description>" . $this->Description . "</Description>\n" .
        "    <IPAddress>" . $this->IPAddress . "</IPAddress>\n" . 
        "    <CCTokenId>" . $this->CCTokenId . "</CCTokenId>\n" . 
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