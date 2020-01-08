<?php

defined('BASEPATH') or exit("No direct script access allowed");

require APPPATH."/libraries/REST_Controller.php";

class Users extends REST_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
	}

	function users_get() {
		$user_id = $this->get($id);

		if($user_id === NULL) {
			$users = $this->User_model->get_all_user();
			$response = array();
			if(!empty($users)) {
				$http_status = HTTP_OK;
				$response['data'] = $users;
				$response['status'] = true;
				$response['message'] = "Record found";
			} else {
				$response['data'] = NULL;
				$response['status'] = false;
				$http_status = HTTP_NOT_FOUND;
				$response['message'] = "No Record found";
			}
			$this->response($response, REST_Controller::$http_status);
		} else {
			$user_id = (int) $user_id;
			if($user_id <= 0) {
				$http_status = HTTP_BAD_REQUEST;
				$response['data'] = NULL;
				$response['status'] = false;
				$response['message'] = "No Record Found";
			} else {
				$data = $this->User_model->getUniqueUserById($user_id);
			}
		}
	}
}