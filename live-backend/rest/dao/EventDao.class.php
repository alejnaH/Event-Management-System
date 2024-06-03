<?php

require_once __DIR__ . '/BaseDao.class.php';

class EventDao extends BaseDao {

    public function __construct() {
        parent::__construct('events');
    }

    public function addEvent($event) {
        return $this->insert('Events', $event);

    }

    public function get_events($offset, $limit, $search, $order_column, $order_direction) {
        $query = "SELECT * 
                  FROM events
                  WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR LOWER(last_name) LIKE CONCAT('%', :search, '%')
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
        return $this->query($query, ['search' => strtolower($search)]);
      }

      public function count_events($search) {
        $query = "SELECT COUNT(*) AS count 
                  FROM events
                  WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR LOWER(last_name) LIKE CONCAT('%', :search, '%')";
        return $this->query_unique($query, ['search' => strtolower($search)]);
      }

      public function get() {
        return $this->get_all(0, 100000);
      }

      public function get_events_by_id($event_id){
        return $this->query_unique("SELECT * FROM events WHERE id = :id", ["id" => $event_id]);
      }
    
      public function delete_event_by_id($event_id) {
        $this->execute("DELETE FROM events WHERE id = :id", ["id" => $event_id]);
      }
    }