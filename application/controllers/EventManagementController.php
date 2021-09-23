<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class EventManagementController extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('EventManagement');
    }
	/*
		This page is for load the event management page in frontend
		It will load once
		Created By Palash Samanta
		Created On 23-09-2021 04-55PM
	*/
	public function loadEventManagement() {
		$info = array();
		$resultData['all_repeat_every'] = $this->EventManagement->getAllRepeatEveryData($info);
		$resultData['all_repeat_every_day'] = $this->EventManagement->getAllRepeatEveryDayData($info);
		$resultData['all_repeat_on_the_count'] = $this->EventManagement->getAllRepeatOnTheCountData($info);
		$resultData['all_repeat_on_the_week'] = $this->EventManagement->getAllRepeatOnTheWeekData($info);
		$resultData['all_repeat_on_the_year'] = $this->EventManagement->getAllRepeatOnTheYearData($info);
		$info['status'] = 1;
		$resultData['all_data'] = $this->EventManagement->getAllData($info);
		//echo "<pre>";print_r($resultData);exit;
		$this->load->view('event_management',$resultData);
	}

	/*
		This page is for add and edit the event management page in frontend
		It will load once
		Created By Palash Samanta
		Created On 23-09-2021 04-55PM
	*/
	public function addEditEvent() {
		try {
			$this->form_validation->set_rules('title', 'Title', 'required|trim|max_length[255]');
			$this->form_validation->set_rules('start_date', 'Start Date', 'required|trim|max_length[10]');
			$this->form_validation->set_rules('end_date', 'End Date', 'required|trim|max_length[10]');
			$this->form_validation->set_rules('recurrence', 'Recurrence', 'required|trim|max_length[1]|numeric');
			$this->form_validation->set_rules('repeat_every_id', 'Repeat Every', 'required|trim|max_length[2]|numeric');
			$this->form_validation->set_rules('repeat_day_id', 'Repeat Day', 'required|trim|max_length[2]|numeric');
			$this->form_validation->set_rules('repeat_on_the_count_id', 'Repeat On The Count', 'required|trim|max_length[2]|numeric');
			$this->form_validation->set_rules('repeat_on_the_week_id', 'Repeat On The Week', 'required|trim|max_length[2]|numeric');
			$this->form_validation->set_rules('repeat_on_the_year_id', 'Repeat On The Year', 'required|trim|max_length[2]|numeric');
			$info = array(
				'title' => $this->input->post('title'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'recurrence' => $this->input->post('recurrence'),
				'status' => 1,
			);
			if($this->input->post('add_edit') == 1){
				$info['added_on']    = date('d-m-Y H:i:s');
				if ($this->form_validation->run() == FALSE) {
					$data['status'] = 'error';
					$data['message'] = 'Wrong input entered, please correct all the input.';
					echo json_encode($data);exit;
				} else {
					if($this->input->post('title') != "") {
						$reccordExistArray['title'] = $this->input->post('title');
					}
					$alreadyExistData = $this->EventManagement->getAllData($reccordExistArray);
					if($alreadyExistData['total_row'] < 1){
						$insertID = $this->EventManagement->insertData($info);
						if($insertID) {
							$recurrenceArray = array();
							$recurrenceArray['recurence_id'] = $insertID;
							if($this->input->post('recurrence') == 1) {
								$recurrenceArray['repeat_every_id'] = $this->input->post('repeat_every_id');
								$recurrenceArray['repeat_day_id'] = $this->input->post('repeat_day_id');
								$insertRepeatID = $this->EventManagement->inserteventRepeatData($recurrenceArray);
								$data['status'] = 'success';
								$data['message'] = 'successfully insert your data.';
								$info = array();
								$data['all_data'] = $this->EventManagement->getAllData($info);
								$data['total_row'] = $data['all_data']['total_row'];
								array_pop($data['all_data']);
								echo json_encode($data);exit;
							} else if($this->input->post('recurrence') == 2) {
								$recurrenceArray['repeat_on_the_count_id'] = $this->input->post('repeat_on_the_count_id');
								$recurrenceArray['repeat_on_the_week_id'] = $this->input->post('repeat_on_the_week_id');
								$recurrenceArray['repeat_on_the_year_id'] = $this->input->post('repeat_on_the_year_id');
								$insertRepeatOnTheID = $this->EventManagement->insertEventRepeatOnTheData($recurrenceArray);
								$data['status'] = 'success';
								$data['message'] = 'successfully insert your data.';
								$info = array();
								$data['all_data'] = $this->EventManagement->getAllData($info);
								$data['total_row'] = $data['all_data']['total_row'];
								array_pop($data['all_data']);
								echo json_encode($data);exit;
							} else {
								$data['status'] = 'error';
								$data['message'] = 'Something went wrong, please try again.';
								echo json_encode($data);exit;
							}
						} 
					} else {
						$data['status'] = 'error';
						$data['message'] = 'Already this title exist.';
						echo json_encode($data);exit;
					}
				}
			} else if($this->input->post('add_edit') == 2){
				$info['updated_on']    = date('d-m-Y H:i:s');
				if ($this->form_validation->run() == FALSE) {
					$data['status'] = 'error';
					$data['message'] = 'Wrong input entered, please correct all the input.';
					echo json_encode($data);exit;
				} else {
					if($this->input->post('event_id') != "") {
						$reccordExistArray['id'] = $this->input->post('event_id');
					}
					$alreadyExistData = $this->EventManagement->getAllData($reccordExistArray);
					//echo "<pre>";print_r($alreadyExistData);exit;
					if($alreadyExistData['total_row'] <= 1){
						$info['id']            = $this->input->post('event_id');
						$this->EventManagement->updateData($info);
						$recurrenceArray = array();
						$recurrenceArray['recurence_id'] = $info['id'];
						if(($this->input->post('recurrence') == 1) && ($alreadyExistData[0]['recurrence'] == 1)) {
							$recurrenceArray['repeat_every_id'] = $this->input->post('repeat_every_id');
							$recurrenceArray['repeat_day_id'] = $this->input->post('repeat_day_id');
							$insertRepeatID = $this->EventManagement->updateeventRepeatData($recurrenceArray);
							$data['status'] = 'success';
							$data['message'] = 'successfully update your data.';
							$info = array();
							$data['all_data'] = $this->EventManagement->getAllData($info);
							$data['total_row'] = $data['all_data']['total_row'];
							array_pop($data['all_data']);
							echo json_encode($data);exit;
						} else if(($this->input->post('recurrence') == 2) && ($alreadyExistData[0]['recurrence'] == 2)) {
							$recurrenceArray['repeat_on_the_count_id'] = $this->input->post('repeat_on_the_count_id');
							$recurrenceArray['repeat_on_the_week_id'] = $this->input->post('repeat_on_the_week_id');
							$recurrenceArray['repeat_on_the_year_id'] = $this->input->post('repeat_on_the_year_id');
							$insertRepeatOnTheID = $this->EventManagement->updateEventRepeatOnTheData($recurrenceArray);
							$data['status'] = 'success';
							$data['message'] = 'successfully update your data.';
							$info = array();
							$data['all_data'] = $this->EventManagement->getAllData($info);
							$data['total_row'] = $data['all_data']['total_row'];
							array_pop($data['all_data']);
							echo json_encode($data);exit;
						} else if(($this->input->post('recurrence') == 1) && ($alreadyExistData[0]['recurrence'] == 2)) {
							$recurrenceArray['repeat_every_id'] = $this->input->post('repeat_every_id');
							$recurrenceArray['repeat_day_id'] = $this->input->post('repeat_day_id');
							$insertRepeatID = $this->EventManagement->inserteventRepeatData($recurrenceArray);
							$this->EventManagement->event_repeat_on_the($deleteArray = array('recurence_id'=>$recurrenceArray['recurence_id']));
							$data['status'] = 'success';
							$data['message'] = 'successfully update your data.';
							$info = array();
							$data['all_data'] = $this->EventManagement->getAllData($info);
							$data['total_row'] = $data['all_data']['total_row'];
							array_pop($data['all_data']);
							echo json_encode($data);exit;
						} else if(($this->input->post('recurrence') == 2) && ($alreadyExistData[0]['recurrence'] == 1)) {
							$recurrenceArray['repeat_on_the_count_id'] = $this->input->post('repeat_on_the_count_id');
							$recurrenceArray['repeat_on_the_week_id'] = $this->input->post('repeat_on_the_week_id');
							$recurrenceArray['repeat_on_the_year_id'] = $this->input->post('repeat_on_the_year_id');
							$insertRepeatOnTheID = $this->EventManagement->insertEventRepeatOnTheData($recurrenceArray);
							$this->EventManagement->deleteEventRepeatData($deleteArray = array('recurence_id'=>$recurrenceArray['recurence_id']));
							$data['status'] = 'success';
							$data['message'] = 'successfully update your data.';
							$info = array();
							$data['all_data'] = $this->EventManagement->getAllData($info);
							$data['total_row'] = $data['all_data']['total_row'];
							array_pop($data['all_data']);
							echo json_encode($data);exit;
						} else {
							$data['status'] = 'error';
							$data['message'] = 'Something went wrong, please try again.';
							echo json_encode($data);exit;
						}
					}
				}
			} else {

			}
		} catch (Exception $e) {
			var_dump($e->getMessage());
		}
	}
	/*
		This page is deleting particular event in frontend
		It will delete once
		Created By Palash Samanta
		Created On 23-09-2021 07-55PM
	*/
	public function deleteEvent(){
		try {
			$info = array(
			'id' => $this->input->post('id'),
			'status' => 2
			);
			$info['updated_on']    = date('d-m-Y H:i:s');
			$this->EventManagement->updateData($info);
			$info1 = array();
			$data['all_data'] = $this->EventManagement->getAllData($info1);
			$data['status'] = 'success';
			$data['total_row'] = $data['all_data']['total_row'];
			array_pop($data['all_data']);
			echo json_encode($data);exit;
		} catch (Exception $e) {
		 	var_dump($e->getMessage());
		}
	}
	/*
		This page is view particular event in frontend
		It will load through ajax
		Created By Palash Samanta
		Created On 23-09-2021 07-55PM
	*/
	public function viewEvent(){
		try {
			$info = array(
			'id' => $this->input->post('id'),
			'status' => 2
			);
			$data['all_data'] = $this->EventManagement->getAllData($info);
			$data['status'] = 'success';
			$data['total_row'] = $data['all_data']['total_row'];
			array_pop($data['all_data']);
			echo json_encode($data);exit;
		} catch (Exception $e) {
		 	var_dump($e->getMessage());
		}
	}

}
