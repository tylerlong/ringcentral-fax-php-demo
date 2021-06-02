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

$request = $rcsdk->createMultipartBuilder()
                 ->setBody(array(
                     'to' => array(
                         array('phoneNumber' => $credentials['receiver']),
                     ),
                     'faxResolution' => 'High',
                 ))
                 ->add('Hello world', 'file.txt')
                 ->add(fopen('test.pdf', 'r'))
                 ->request('/account/~/extension/~/fax');

$r = $platform->sendRequest($request);
print_r($r->json());
