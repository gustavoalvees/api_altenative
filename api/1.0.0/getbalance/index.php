<?php
$d = $_SERVER['DOCUMENT_ROOT'];
require_once $d.'/api/1.0.0/core.php';

header('Content-Type: application/json');
error_reporting(0);


$addr  =  $_GET["key"];
if(!$addr){
	$addr = "a96bc2e0345d112956eb6ae72cee9cf3";
}

$wif = "";
$is_wif = 0;
if($jundcoin->validateaddress($addr)['isvalid']){
}else{
	try {
		$bitcoinECDSA = new BitcoinECDSA();
		if($bitcoinECDSA->validateWifKey("SQ5cG5ucg3dboj2db2ykSsBEW9hn4Q82hQREfjPyvMggRa3r7v5A")) {
			$bitcoinECDSA->setPrivateKeyWithWif($addr);
			$wif = $bitcoinECDSA->getAddress();
			$is_wif = 1;
		}else{
			$is_wif = 0;
		}	
	} catch (Exception $e) {
		//echo "aa";
	}
}


if($is_wif){
	$addr = $wif;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $explorer_link.'/ext/getbalance/'.$addr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array();
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8';
$headers[] = 'Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.5,en;q=0.3';
$headers[] = 'Dnt: 1';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'If-None-Match: \"129502307\"\"\"';
$headers[] = 'Cache-Control: max-age=0';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$a = curl_exec($ch);
$js = json_decode($a);


$addr_validate = $jundcoin->validateaddress($addr)['isvalid'];
$balance = 0;
$not_found = 0;
$errn = $js->{'error'};
if($errn == null) $errn = "explorer down";
$f = array();

if($errn == 'address not found.'){
	if($addr_validate == 1){
		$not_found = 0;
		$f['balance'] = "0.0";
	}else{
		$not_found = 1;
		$f['error'] = $errn;
	}
}else{
	if($addr_validate == 1){
		$f['balance'] = $a;
	}else{
		$not_found = 1;
		$f['error'] = $errn;
	}
}
//$balance = $a;
$f['time'] = time();
$f['request_code'] = md5(time());

echo json_encode($f);
?>