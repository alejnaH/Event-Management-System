<?php

require_once __DIR__ . '/../services/AuthService.class.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set('auth_service', new AuthService());

Flight::group('/auth', function() {
    Flight::route('POST /login', function() {
        $payload = Flight::request()->data->getData();

        $event = Flight::get('auth_service')->get_user_by_email($payload['email']);

        if(!$event || !password_verify($payload['password'], $event['password']))
            Flight::halt(500, "Invalid username or password");

        unset($event['password']);
        
        $jwt_payload = [
            'user' => $event,
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24) 
        ];

        $token = JWT::encode(
            $jwt_payload,
            Config::JWT_SECRET(),
            'HS256'
        );

        Flight::json(
            array_merge($event, ['token' => $token])
        );
    });

    Flight::route('POST /logout', function() {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if(!$token)
                Flight::halt(401, "Missing authentication header");

            $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

            Flight::json([
                'jwt_decoded' => $decoded_token,
                'user' => $decoded_token->user
            ]);
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    });
});