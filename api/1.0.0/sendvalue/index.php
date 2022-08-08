<?php
#header('Content-Type: application/json');
$d = $_SERVER['DOCUMENT_ROOT'];
require_once $d.'/api/1.0.0/core.php';
#header('Content-Type: application/json');
#error_reporting(0);
$hash = md5(base64_encode(rand()));
$key = "xxx"; // private key


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

echo $key;
echo "<br>";
echo $d;
$jundcoin->settxfee($fee);
echo "<br>";
echo $fee;
$jundcoin->importprivkey($key,$hash);
echo "<br>";
echo $hash;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $explorer_link.'/ext/getaddress/'.$d);
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


$balance = $js->{'balance'};
$value_to_send = 0.6000000;
$address_to_send = #"JqNLiiiK9988iFGov3spAEhXq7YBo6tfvv";
$v_send = $value_to_send+$fee;
if($balance >= $v_send){
	$txid_final = $jundcoin->sendfrom($hash,$address_to_send,$value_to_send);
	echo $txid_final;
}else{
	echo "<br> não possui valor...";
}



$jundcoin->setaccount($d,"");
?>