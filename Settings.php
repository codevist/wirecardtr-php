<?php

/*
Tüm çağrılarda kullanılacak olan ayarların tutulduğu kısımdır.
*/
class Settings
{      
    public function Settings()
    {
        $this->UserCode="";//"Wirecard tarafından sizlere verilen User Code bilgisi",
        $this->Pin="";//"Wirecard tarafından sizlere verilen Pin bilgisi",
        $this->BaseUrl="https://www.wirecard.com.tr/SGate/Gate"; //Wirecard web servisleri API url'lerinin bilgisidir. 
    }
    public $UserCode;
    public $Pin;
    public $BaseUrl;
}