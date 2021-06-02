<?php
require('vendor/autoload.php');

$rcsdk = new RingCentral\SDK\SDK(getenv('RINGCENTRAL_CLIENT_ID'),
                                 getenv('RINGCENTRAL_CLIENT_SECRET'),
      	                         getenv('RINGCENTRAL_SERVER_URL'));
$platform = $rcsdk->platform();
$platform->login(getenv('RINGCENTRAL_USERNAME'),
                  getenv('RINGCENTRAL_EXTENSION'),
                  getenv('RINGCENTRAL_PASSWORD'));

$r = $platform->get('/restapi/v1.0/account/~/extension/~');
print_r($r->json());
