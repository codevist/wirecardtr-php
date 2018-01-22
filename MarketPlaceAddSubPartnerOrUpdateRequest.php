<?php

class MarketPlaceAddOrUpdateRequest
{
    public  $ServiceType; 
    public  $OperationType; 
    public  $Token; 
    public  $UniqueId; 
    public  $SubPartnerType; 
    public  $Name; 
    public  $ContactInfo; 
    public  $FinancialInfo; 
    public  $SubPartnerId; 

    public static function Execute(MarketPlaceAddOrUpdateRequest $request)
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
        "    <UniqueId>" . $this->UniqueId . "</UniqueId>\n" .
        "    <SubPartnerId>" . $this->SubPartnerId . "</SubPartnerId>\n" .
        "    <SubPartnerType>" . $this->SubPartnerType . "</SubPartnerType>\n" .
        "    <Name>" . $this->Name . "</Name>\n" .
        "    <ContactInfo>\n" .
        "        <Country>" . urlencode($this->ContactInfo->Country) . "</Country>\n" .
        "        <City>" . urlencode($this->ContactInfo->City) . "</City>\n" .
        "        <Address>" . urlencode($this->ContactInfo->Address) . "</Address>\n" .
        "        <BusinessPhone>" . urlencode($this->ContactInfo->BusinessPhone) . "</BusinessPhone>\n" .
        "        <MobilePhone>" . urlencode($this->ContactInfo->MobilePhone) . "</MobilePhone>\n" .
        "    </ContactInfo>\n" .
        "    <FinancialInfo>\n" .
        "        <IdentityNumber>" . urlencode($this->FinancialInfo->IdentityNumber) . "</IdentityNumber>\n" .
        "        <TaxOffice>" . urlencode($this->FinancialInfo->TaxOffice) . "</TaxOffice>\n" .
        "        <TaxNumber>" . urlencode($this->FinancialInfo->TaxNumber) . "</TaxNumber>\n" .
        "        <BankName>" . urlencode($this->FinancialInfo->BankName) . "</BankName>\n" .
        "        <IBAN>" . urlencode($this->FinancialInfo->IBAN) . "</IBAN>\n" .
        "        <AccountName>" . urlencode($this->FinancialInfo->AccountName) . "</AccountName>\n" .
        "    </FinancialInfo>\n" .
        "</WIRECARD>";
         return $xml_data;
    }
}