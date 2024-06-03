<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/EventDao.class.php'; // Make sure to include your EventDao class

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $description = $_POST['description'];

    if (empty($event_name) || empty($date) || empty($time) || empty($country) || empty($city) || empty($address) || empty($description)) {
        echo "Please fill in all fields";
        exit; // Stop execution
    }

    try {
        $event_dao = new EventDao();

        $event = [
            "event_name" => $event_name,
            "date" => $date,
            "time" => $time,
            "description" => $description,
            "country" => $country,    
            "city" => $city
        ];

        $event_dao->addEvent($event);

        echo "Event hosted successfully!";
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    }
} else {
    echo "Form submission method not allowed";
}
