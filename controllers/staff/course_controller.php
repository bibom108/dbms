<?php
require_once('controllers/staff/base_controller.php');
require_once('models/user.php');

class CourseController extends BaseController
{
	function __construct()
	{
		$this->folder = 'course';
	}
    public function index()
	{
		session_start();
        $this->render('index');
    }
	public function update() {
		session_start();
	}
}