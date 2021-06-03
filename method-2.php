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

exec('curl -i "https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/fax" ' . 
'-H "Accept: application/json" ' .
'-H "Authorization: Bearer ' . $platform->auth()->data()['access_token'] . '" ' .
'-F "request=@request.json;type=application/json" ' .
'-F "attachment=@test.txt;type=text/plain" ' .
'-F "attachment=@test.pdf;type=application/pdf"'
);
