<?php
class MarketPlaceDeactiveRequest
{
    public  $ServiceType; 
    public  $OperationType; 
    public  $Token; 
    public  $UniqueId; 

    public static function Execute(MarketPlaceDeactiveRequest $request)
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
        "</WIRECARD>";
         return $xml_data;
    }
}