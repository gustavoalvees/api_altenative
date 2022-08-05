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
$f['testnet'] = false;
   
$ck = [
		'pubkey_andress'=>44,
		'script_andress'=>33,
		'secretkey_andress'=>171,
		'alert_pubKey' => '043464524a9bd29bd5fa04e3d525bf126f5e99dd333d8676abe4c8a6b8e76a80847b99de68cadb4cce3ee61fe117ead378047bc7123b82d2645d2c5aad4212ce9b',
	];
$f['creaction_key'] = $ck;
$f['fee-per-jdc'] = $fee;
$f['time'] = time();
$f['request_code'] = md5(time());

echo json_encode($f);
?>