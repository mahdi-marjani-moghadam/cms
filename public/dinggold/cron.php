<?php

echo date('Y-m-d H:i:s'). ' ';
$url = 'https://dinggold.ir/runcronjob';
$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($handle);
curl_close($handle);
print_r($data) ;
echo "\n";
