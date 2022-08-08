<?php
#header('Content-Type: application/json');
$d = $_SERVER['DOCUMENT_ROOT'];
require_once $d.'/api/1.0.0/core.php';
header('Content-Type: application/json');
error_reporting(0);
$hash = md5(base64_encode(rand()));
$key = $_GET["key"];

$not_found = 0;
$wif = $key;
$bitcoinECDSA = new BitcoinECDSA();
$d = '';
if($bitcoinECDSA->validateWifKey($wif)) {
	$bitcoinECDSA->setPrivateKeyWithWif($wif);
	$address = $bitcoinECDSA->getAddress();
	$d = $address;
	$not_found = 0;
} else {
	$not_found = 1;
}



function mask ( $str, $start = 0, $length = null ) {
    $mask = preg_replace ( "/\S/", "*", $str );
    if( is_null ( $length )) {
        $mask = substr ( $mask, $start );
        $str = substr_replace ( $str, $mask, $start );
    }else{
        $mask = substr ( $mask, $start, $length );
        $str = substr_replace ( $str, $mask, $start, $length );
    }
    return $str;
}



if($not_found){
	$ck = array();
	$ck = [
			'error'=>'address private not found!',
			'time'=>time(),
			'hash'=>$hash,
		];

}else{
	$ck = array();
	$ck = [
			'address'=>$d,
			'private_key'=>mask($key,null,35),
			'time'=>time(),
			'hash'=>$hash,
		];
}

echo json_encode($ck);


?>