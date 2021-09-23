<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class EventManagement extends CI_Model{
        public function __construct() {
            parent::__construct();
        }

        function insertData($data){
            $this->db->insert('event_list', $data);
            return $this->db->insert_id();
        }
        function inserteventRepeatData($data){
            $this->db->insert('event_repeat', $data);
            return $this->db->insert_id();
        }
        function insertEventRepeatOnTheData($data){
            $this->db->insert('event_repeat_on_the', $data);
            return $this->db->insert_id();
        }

        function updateData($data){
            //print_r($data);exit;
            if(isset($data['status']) && !empty($data['status'])){
            $this->db->where('id',$data['id']);
            } else {
            if(isset($data['id']) && !empty($data['id'])){
            $this->db->where('id',$data['id']);
            }
            }
            $this->db->update('event_list', $data);
        }
        function updateeventRepeatData($data){
            //print_r($data);exit;
            if(isset($data['status']) && !empty($data['status'])){
            $this->db->where('id',$data['id']);
            } else {
            if(isset($data['recurence_id']) && !empty($data['recurence_id'])){
            $this->db->where('recurence_id',$data['recurence_id']);
            }
            }
            $this->db->update('event_repeat', $data);
        }
        function updateEventRepeatOnTheData($data){
            //print_r($data);exit;
            if(isset($data['status']) && !empty($data['status'])){
            $this->db->where('id',$data['id']);
            } else {
            if(isset($data['recurence_id']) && !empty($data['recurence_id'])){
            $this->db->where('recurence_id',$data['recurence_id']);
            }
            }
            $this->db->update('event_repeat_on_the', $data);
        }

        function deleteEventRepeatData($data){
            $this->db->delete('event_repeat', array('recurence_id' => $data['recurence_id']));
        }

        function deleteEventRepeatOnTheData($data){
            $this->db->delete('event_repeat_on_the', array('recurence_id' => $data['recurence_id']));
        }
        
        function getAllData($data){
            //print_r($data);exit;
            $this->db->select('event_list.*,event_repeat.repeat_every_id,event_repeat.repeat_day_id,
            event_repeat_on_the.repeat_on_the_count_id,event_repeat_on_the.repeat_on_the_week_id,event_repeat_on_the.repeat_on_the_year_id');
            $this->db->from('event_list');
            $this->db->join('event_repeat', 'event_repeat.recurence_id = event_list.id', 'left');
            $this->db->join('event_repeat_on_the', 'event_repeat_on_the.recurence_id = event_list.id', 'left');
            $this->db->where('event_list.status',1);
            if(isset($data['id']) && !empty($data['id'])){
                $this->db->where('event_list.id', $data['id']);
            }
            if(isset($data['title']) && !empty($data['title'])){
                $this->db->where('event_list.title', $data['title']);
            }
            if(isset($data['sort_type']) && !empty($data['sort_type']) && isset($data['sort_on']) && !empty($data['sort_on'])){
                $this->db->order_by($data['sort_on'], $data['sort_type']);
            } else {
                $this->db->order_by('event_list.id', 'DESC');
            }
            $tempdb = clone $this->db;
            $num_results = $tempdb->count_all_results();
            //print_r($num_results);exit;
            if(isset($data['start']) && isset($data['limit'])){
            $this->db->limit($data['limit'], $data['start']);
            }
            $query = $this->db->get();
            //print_r($this->db->last_query());exit;
            if ( $query->num_rows() > 0 ) {
            $row = $query->result_array();
            $row['total_row'] = $num_results;
            return $row;
            } else {
            $row = [];
            $row['total_row'] = 0;
            return $row;
            }
        }
        function getAllRepeatEveryData($data){
            //print_r($data);exit;
            $this->db->select('repeat_every.*');
            $this->db->from('repeat_every');
            if(isset($data['id']) && !empty($data['id'])){
            $this->db->where('repeat_every.id', $data['id']);
            }
            if(isset($data['sort_type']) && !empty($data['sort_type']) && isset($data['sort_on']) && !empty($data['sort_on'])){
            $this->db->order_by($data['sort_on'], $data['sort_type']);
            } else {
            $this->db->order_by('repeat_every.id', 'asc');
            }
            $tempdb = clone $this->db;
            $num_results = $tempdb->count_all_results();
            //print_r($num_results);exit;
            if(isset($data['start']) && isset($data['limit'])){
            $this->db->limit($data['limit'], $data['start']);
            }
            $query = $this->db->get();
            //print_r($this->db->last_query());exit;
            if ( $query->num_rows() > 0 ) {
            $row = $query->result_array();
            $row['total_row'] = $num_results;
            return $row;
            } else {
            $row = [];
            $row['total_row'] = 0;
            return $row;
            }
        }
        function getAllRepeatEveryDayData($data){
            //print_r($data);exit;
            $this->db->select('repeat_day.*');
            $this->db->from('repeat_day');
            if(isset($data['id']) && !empty($data['id'])){
            $this->db->where('repeat_day.id', $data['id']);
            }
            if(isset($data['sort_type']) && !empty($data['sort_type']) && isset($data['sort_on']) && !empty($data['sort_on'])){
            $this->db->order_by($data['sort_on'], $data['sort_type']);
            } else {
            $this->db->order_by('repeat_day.id', 'asc');
            }
            $tempdb = clone $this->db;
            $num_results = $tempdb->count_all_results();
            //print_r($num_results);exit;
            if(isset($data['start']) && isset($data['limit'])){
            $this->db->limit($data['limit'], $data['start']);
            }
            $query = $this->db->get();
            //print_r($this->db->last_query());exit;
            if ( $query->num_rows() > 0 ) {
            $row = $query->result_array();
            $row['total_row'] = $num_results;
            return $row;
            } else {
            $row = [];
            $row['total_row'] = 0;
            return $row;
            }
        }
        function getAllRepeatOnTheCountData($data){
            //print_r($data);exit;
            $this->db->select('repeat_on_the_count.*');
            $this->db->from('repeat_on_the_count');
            if(isset($data['id']) && !empty($data['id'])){
            $this->db->where('repeat_on_the_count.id', $data['id']);
            }
            if(isset($data['sort_type']) && !empty($data['sort_type']) && isset($data['sort_on']) && !empty($data['sort_on'])){
            $this->db->order_by($data['sort_on'], $data['sort_type']);
            } else {
            $this->db->order_by('repeat_on_the_count.id', 'asc');
            }
            $tempdb = clone $this->db;
            $num_results = $tempdb->count_all_results();
            //print_r($num_results);exit;
            if(isset($data['start']) && isset($data['limit'])){
            $this->db->limit($data['limit'], $data['start']);
            }
            $query = $this->db->get();
            //print_r($this->db->last_query());exit;
            if ( $query->num_rows() > 0 ) {
            $row = $query->result_array();
            $row['total_row'] = $num_results;
            return $row;
            } else {
            $row = [];
            $row['total_row'] = 0;
            return $row;
            }
        }
        function getAllRepeatOnTheWeekData($data){
            //print_r($data);exit;
            $this->db->select('repeat_on_the_week.*');
            $this->db->from('repeat_on_the_week');
            if(isset($data['id']) && !empty($data['id'])){
            $this->db->where('repeat_on_the_week.id', $data['id']);
            }
            if(isset($data['sort_type']) && !empty($data['sort_type']) && isset($data['sort_on']) && !empty($data['sort_on'])){
            $this->db->order_by($data['sort_on'], $data['sort_type']);
            } else {
            $this->db->order_by('repeat_on_the_week.id', 'asc');
            }
            $tempdb = clone $this->db;
            $num_results = $tempdb->count_all_results();
            //print_r($num_results);exit;
            if(isset($data['start']) && isset($data['limit'])){
            $this->db->limit($data['limit'], $data['start']);
            }
            $query = $this->db->get();
            //print_r($this->db->last_query());exit;
            if ( $query->num_rows() > 0 ) {
            $row = $query->result_array();
            $row['total_row'] = $num_results;
            return $row;
            } else {
            $row = [];
            $row['total_row'] = 0;
            return $row;
            }
        }
        function getAllRepeatOnTheYearData($data){
            //print_r($data);exit;
            $this->db->select('repeat_on_the_year.*');
            $this->db->from('repeat_on_the_year');
            if(isset($data['id']) && !empty($data['id'])){
            $this->db->where('repeat_on_the_year.id', $data['id']);
            }
            if(isset($data['sort_type']) && !empty($data['sort_type']) && isset($data['sort_on']) && !empty($data['sort_on'])){
            $this->db->order_by($data['sort_on'], $data['sort_type']);
            } else {
            $this->db->order_by('repeat_on_the_year.id', 'asc');
            }
            $tempdb = clone $this->db;
            $num_results = $tempdb->count_all_results();
            //print_r($num_results);exit;
            if(isset($data['start']) && isset($data['limit'])){
            $this->db->limit($data['limit'], $data['start']);
            }
            $query = $this->db->get();
            //print_r($this->db->last_query());exit;
            if ( $query->num_rows() > 0 ) {
            $row = $query->result_array();
            $row['total_row'] = $num_results;
            return $row;
            } else {
            $row = [];
            $row['total_row'] = 0;
            return $row;
            }
        }
    }
?>