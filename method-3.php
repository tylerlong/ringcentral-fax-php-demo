<?php
require('vendor/autoload.php');
$credentials = require(__DIR__ . '/credentials.php');

$rcsdk = new RingCentral\SDK\SDK($credentials['clientId'],
                                 $credentials['clientSecret'],
      	                         $credentials['server']
);
$platform = $rcsdk->platform();
$platform->login($credentials['username'],
                $credentials['extension'],
                $credentials['password']
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/fax');
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $platform->auth()->data()['access_token']));
curl_setopt($curl, CURLOPT_POSTFIELDS, array('file1' => curl_file_create('request.json', 'application/json'), 
                                              'file2' => curl_file_create('test.txt', 'text/plain'), 
                                              'file3' => curl_file_create('test.pdf', 'application/pdf')));
$result = curl_exec($curl);
curl_close($curl);
