<?php

require_once __DIR__ . '/../dao/EventDao.class.php';

class EventService {
    private $event_dao;
    public function __construct() {
        $this->event_dao = new EventDao();
    }
    public function add_event($event){
        $event['password'] = password_hash($event['password'], PASSWORD_BCRYPT);
        return $this->event_dao->add_patient($event);
    }
    public function get_events_paginated($offset, $limit, $search, $order_column, $order_direction){
        $count = $this->event_dao->count_events_paginated($search)['count'];
        $rows = $this->event_dao->get_events_paginated($offset, $limit, $search, $order_column, $order_direction);

        foreach($rows as $id => $event) {
            $rows[$id]['action'] = '<div class="btn-group" role="group" aria-label="Actions">' .
                                                '<button type="button" class="btn btn-warning" onclick="EventService.open_edit_event_modal('. $event['id'] .')">Edit</button>' .
                                                '<button type="button" class="btn btn-danger" onclick="EventService.delete_event('. $event['id'] .')">Delete</button>' .
                                            '</div>';
        }

        return [
            'count' => $count,
            'data' => $rows
        ];
    }
    public function delete_event_by_id($event_id) {
        $this->event_dao->delete_event_by_id($event_id);
    }

    public function get_event_by_id($event_id) {
        return $this->patient_dao->get_event_by_id($event_id);
    }

    public function edit_event($event) {
        $id = $event['id'];
        unset($event['id']);

        $this->event_dao->edit_event($id, $event);
    }

    public function get_all_events(){
        return $this->eventt_dao->get_all_events();
    }
}