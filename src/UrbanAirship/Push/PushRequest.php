<?php
/*
Copyright 2013-2016 Urban Airship and Contributors
*/

namespace UrbanAirship\Push;

use UrbanAirship\UALog;

class PushRequest
{
    const PUSH_URL = "/api/push/";
    private $airship;
    private $audience;
    private $notification;
    private $options = null;
    private $deviceTypes;
    private $message;
    private $inAppMessage;

    function __construct($airship)
    {
        $this->airship = $airship;
    }

    function setAudience($audience)
    {
        $this->audience = $audience;
        return $this;
    }

    function setNotification($notification)
    {
        $this->notification = $notification;
        return $this;
    }

    function setDeviceTypes($deviceTypes)
    {
        $this->deviceTypes = $deviceTypes;
        return $this;
    }

    function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    function setInAppMessage($inAppMessage)
    {
        $this->inAppMessage = $inAppMessage;
        return $this;
    } 

    function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    function getPayload()
    {
        $payload = array(
            'audience' => $this->audience,
            'notification' => $this->notification,
            'device_types' => $this->deviceTypes
        );
        if (!is_null($this->message)) {
            $payload['message'] = $this->message;
        }
        if (!is_null($this->inAppMessage)) {
            $payload['in_app'] = $this->inAppMessage;
        }
        if (!is_null($this->options)) {
            $payload['options'] = $this->options;
        }
        return $payload;
    }

    function send()
    {
        $uri = $this->airship->buildUrl(self::PUSH_URL);
        $logger = UALog::getLogger();

        $response = $this->airship->request("POST",
            json_encode($this->getPayload()), $uri, "application/vnd.urbanairship+json", 3);

        $payload = json_decode($response->raw_body, true);
        $logger->info("Push sent successfully.", array("push_ids" => $payload['push_ids']));
        return new PushResponse($response);
    }

}
