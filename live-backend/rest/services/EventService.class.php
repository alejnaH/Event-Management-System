<?php

require_once __DIR__ . '/../dao/EventDao.class.php';

class EventService {
    private $event_dao;
    public function __construct() {
        $this->event_dao = new Event_Dao();
    }
        
    public function add_event($event) {
        return $this->event_dao->add_event($event);
    }

}
