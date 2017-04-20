<?php

require_once 'vendor/autoload.php';

use UrbanAirship\Airship;
use UrbanAirship\UALog;
use UrbanAirship\Push as P;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

UALog::setLogHandlers(array(new StreamHandler("php://stdout", Logger::INFO)));
//$airship = new Airship("vOA84jJUSq-8hVTjEBWtpw", "l6QkRjZGQM2e0-sd1Zgsvg");

$airship = new Airship("7MmAu9yWTl-Hb_q7631J0w", "Fsz9GNOyT4i1J-h74d0LEg");

$response = $airship->push()
    ->setAudience(P\all))
    ->setNotification(P\notification("Hello from PHP"))
    ->setDeviceTypes(P\all)
    ->send();

print "<pre>";
print_r($response);    
print "</pre>";