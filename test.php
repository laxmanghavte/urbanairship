<?php
require_once 'vendor/autoload.php';

use Urbanairship\Airship;
use UrbanAirship\Push as P;

$response = $airship->push()
    ->setAudience(P\deviceToken("9427c597-d1c7-4ca8-8af4-9423c218ad0d"))
    ->setNotification(P\notification("Hello from php!"))
    ->setDeviceTypes(P\all)
    ->send();

print "Push sent!. Push IDs:" . $response.push_ids;

?>