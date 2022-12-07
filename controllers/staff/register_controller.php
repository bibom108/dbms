<?php
require_once('controllers/staff/base_controller.php');
require_once('models/user.php');

class RegisterController extends BaseController
{
	function __construct()
	{
		$this->folder = 'register';
	}

	public function index()
	{
		$this->render('index');
	}

	public function submit()
	{
		//Cái này là đăng ký nè
	}

	public function editInfo()
	{
		session_start();
	}

	public function editPass()
	{
		
	}

	public function delete()
	{

	}
}