<?php
header('Content-Type: application/json');
$d = $_SERVER['DOCUMENT_ROOT'];
require_once $d.'/api/1.0.0/core.php';

$private = new PrivateKey();
$wallet = new Wallet($private);
$key = $private->getPrivateKey();
$private_key = AddressCodec::WIF($key,'ab',true,false);
$deWif = AddressCodec::DeWIF($private_key,true,false);
$addr = $wallet->getAddress();

$ck = [
		'new_address'=>[
			'public_key'=>$addr,
			'private_key'=>$private_key,
		],
	];

$ck['time'] = time();
$ck['request_code'] = md5(time());

echo json_encode($ck);
?>