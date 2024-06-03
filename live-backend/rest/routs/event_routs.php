<?php

require_once __DIR__ . '/../services/EventService.class.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set('event_service', new EventService());

Flight::group('/events', function() {
    

    Flight::route('GET /info', function() {
        Flight::json(Flight::get('event_service')->get_event_by_id(Flight::get('user')->id));
    });

    Flight::route('GET /all', function() {
        $data = Flight::get('event_service')->get_all_events();
        Flight::json($data, 200);
    });

    Flight::route('GET /event', function() {
        $params = Flight::request()->query;

        $patient = Flight::get('event_service')->get_event_by_id($params['event_id']);
        Flight::json($event);
    });


    Flight::route('GET /get/@event_id', function($event_id) {
        $patient = Flight::get('event_service')->get_patient_by_id($event_id);
        Flight::json($event);
    });

    Flight::route('GET /', function() {
        $payload = Flight::request()->query;

        $params = [
            'start' => (int)$payload['start'],
            'search' => $payload['search']['value'],
            'draw' => $payload['draw'],
            'limit' => (int)$payload['length'],
            'order_column' => $payload['order'][0]['name'],
            'order_direction' => $payload['order'][0]['dir'],
        ];

        $data = Flight::get('event_service')->get_events_paginated($params['start'], $params['limit'], $params['search'], $params['order_column'], $params['order_direction']);

        Flight::json([
            'draw' => $params['draw'],
            'data' => $data['data'],
            'recordsFiltered' => $data['count'],
            'recordsTotal' => $data['count'],
            'end' => $data['count']
        ], 200);
    });

    Flight::route('POST /add', function() {
        $payload = Flight::request()->data->getData();

        if($payload['first_name'] == NULL || $payload['first_name'] == '') {
            Flight::halt(500, "First name field is missing");
        }

        if($payload['id'] != NULL && $payload['id'] != ''){
            $event = Flight::get('event_service')->edit_event($payload);
        } else {
            unset($payload['id']);
            $event = Flight::get('event_service')->add_event($payload);
        }

        Flight::json(['message' => "You have successfully added the patient", 'data' => $event]);
    });

    Flight::route('DELETE /delete/@event_id', function($event_id) {
        if($event_id == NULL || $event_id == '') {
            Flight::halt(500, "You have to provide valid patient id!");
        }

        Flight::get('event_service')->delete_patient_by_id($event_id);
        Flight::json(['message' => 'You have successfully deleted the patient!'], 200);
    });

    Flight::route('GET /@event_id', function($event_id) {
        $patient = Flight::get('event-service')->get_patient_by_id($event_id);

        Flight::json($event, 200);
    });
});