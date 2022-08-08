<?php
$d = $_SERVER['DOCUMENT_ROOT'];
require_once $d.'/api/1.0.0/core.php';
header('Content-Type: application/json');

$f = $jundcoin->getinfo();


unset($f['balance']);
unset($f['stake']);
unset($f['newmint']); 
unset($f['ip']);
unset($f['proxy']);
unset($f['connections']);
unset($f['errors']);
unset($f['mininput']);
unset($f['timeoffset']);
unset($f['paytxfee']);
unset($f['protocolversion']);
unset($f['walletversion']);
$f['version'] = '1.0.0-api';
//$f['testnet'] = false;
   
$ck = [
		'pubkey_andress'=>$pubkey_andress,
		'script_andress'=>$script_andress,
		'secretkey_andress'=>$secretkey_andress,
		'prefix'=>$prefix,
		'alert_pubKey' =>$alert_pub,
	];
$f['creaction_key'] = $ck;
$f['fee-per-jdc'] = $fee;
$f['time'] = time();
$f['request_code'] = md5(time());

echo json_encode($f);
?>