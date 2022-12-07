<?php
require_once('controllers/student/base_controller.php');
require_once('models/user.php');

class MyReSultController extends BaseController
{
	function __construct()
	{
		$this->folder = 'myresult';
	}
    public function index()
	{
		session_start();
		if (!isset($_SESSION['idStudent']))
		{
			header('Location: index.php?page=student&controller=layouts&action=index');
		}
        else {
            $this->render('index');
        }
    }
}