<?php

require_once __DIR__ . '/rest/services/EventService.class.php';

$payload = $_REQUEST;

if($payload['first_nam'] == NULL || $payload ['first_name' == '']) {
    header('HTTP/1.1 500 Bad Request');
    die(json_encode(['error' => "First name field is missing"]));
}


$event_service = new EventService();
$event_service->add_event([]);