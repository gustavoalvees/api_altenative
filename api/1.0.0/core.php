<?php
$d = $_SERVER['DOCUMENT_ROOT'];
require_once $d.'/api/rpc/jsonrpc.php';
$jundcoin = new jsonRPCClient('http://admin:admin2@127.0.0.1:70/');
$explorer_link = "http://144.91.87.7:3023";
$fee = 0.00030000;

?>