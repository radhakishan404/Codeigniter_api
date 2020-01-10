<?php

defined('BASEPATH') or exit("No direct script access allowed");

require APPPATH."/libraries/REST_Controller.php";

class Users extends REST_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
	}

	function users_get() {
		$user_id = $this->get('id');
		$response = array();

		if($user_id === NULL) {
			$users = $this->User_model->get_all_user();
			if(!empty($users)) {
				$response['data'] = $users;
				$response['status'] = true;
				$response['message'] = "Record found";
				$this->response($response, REST_Controller::HTTP_OK);
			} else {
				$response['data'] = NULL;
				$response['status'] = false;
				$response['message'] = "No Record found";
				$this->response($response, REST_Controller::HTTP_NOT_FOUND);
			}
		} else {
			$user_id = (int) $user_id;
			if($user_id <= 0) {
				$response['data'] = NULL;
				$response['status'] = false;
				$response['message'] = "No Record Found";
				$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
			} else {
				$data = $this->User_model->getUniqueUserById($user_id);
				if(!empty($data)) {
					$response['data'] = $data;
					$response['status'] = true;
					$response['message'] = "Record found";
					$this->response($response, REST_Controller::HTTP_OK);
				} else {
					$response['data'] = NULL;
					$response['status'] = false;
					$response['message'] = "No Record found";
					$this->response($response, REST_Controller::HTTP_NOT_FOUND);
				}
			}
		}
	}
}