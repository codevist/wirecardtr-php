<?php
class Helper {


    //Guid oluşturmak için kullanılan metottur.
	public static function GUID() {
		if (function_exists ( 'com_create_guid' ) === true) {
			return trim ( com_create_guid (), '{}' );
		}
		
		return sprintf ( '%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand ( 0, 65535 ), mt_rand ( 0, 65535 ), mt_rand ( 0, 65535 ), mt_rand ( 16384, 20479 ), mt_rand ( 32768, 49151 ), mt_rand ( 0, 65535 ), mt_rand ( 0, 65535 ), mt_rand ( 0, 65535 ) );
	}
	//Client ipsine ulaşmamızı sağlayan kısımdır.
	public static function get_client_ip() {
		if (getenv ( 'HTTP_CLIENT_IP' ))
			$ipaddress = getenv ( 'HTTP_CLIENT_IP' );
		else if (getenv ( 'HTTP_X_FORWARDED_FOR' ))
			$ipaddress = getenv ( 'HTTP_X_FORWARDED_FOR' );
		else if (getenv ( 'HTTP_X_FORWARDED' ))
			$ipaddress = getenv ( 'HTTP_X_FORWARDED' );
		else if (getenv ( 'HTTP_FORWARDED_FOR' ))
			$ipaddress = getenv ( 'HTTP_FORWARDED_FOR' );
		else if (getenv ( 'HTTP_FORWARDED' ))
			$ipaddress = getenv ( 'HTTP_FORWARDED' );
		else if (getenv ( 'REMOTE_ADDR' ))
			$ipaddress = getenv ( 'REMOTE_ADDR' );
		else
			$ipaddress = '127.0.0.1';
		
		return $ipaddress;
	}

	/**
	 * Xml çıktısı oluşturmamıza olanak sağlayan metod.
	 */
	public static function formattoXMLOutput($input_xml) {
		$doc = new DOMDocument ();
		$doc->loadXML ( $input_xml );
		$doc->preserveWhiteSpace = false;
		$doc->formatOutput = true;
		$output = $doc->saveXML ();
		return $output;
	}
	/**
	 * Geçerli url yolunu üretir.
	 * @method "request scheme" + "://" + "server name" + "server port"
	 * @return string
	 */
	public static function getCurrentUrl() {
		return "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."";
	}
	
	
}

?>
