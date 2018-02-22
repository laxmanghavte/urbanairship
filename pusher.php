<?php

require_once 'vendor/autoload.php';

use UrbanAirship\Airship;
use UrbanAirship\UALog;
use UrbanAirship\Push as P;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/* new urban airship */
UALog::setLogHandlers(array(new StreamHandler("php://stdout", Logger::INFO)));
$airship = new Airship("7MmAu9yWTl-Hb_q7631J0w", "6gmS3e57RcuIOEoBrWP7kQ");

$response = $airship->push()
    ->setAudience(P\all)
    ->setNotification(P\notification("Hello from PHP"))
    ->setDeviceTypes(P\all)
    ->send();
print "<pre>";
print_r($response);
print "</pre>";
