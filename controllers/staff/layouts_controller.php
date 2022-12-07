<?php
require_once('controllers/staff/base_controller.php');
require_once('models/staff.php');

class LayoutsController extends BaseController
{
	function __construct()
	{
		$this->folder = 'layouts';
	}

	public function index()
	{
		session_start();
		if (isset($_SESSION['id']))
		{
			header('Location: index.php?page=staff&controller=layouts&action=index');
		}
		else if (isset($_POST['submit']))
		{
			$username = $_POST['username'];
			$password = $_POST['pwd'];
			unset($_POST);
			$check = Staff::validation($username, $password);
			if ($check == 1)
			{
				$db = DB::getInstance();
				$_SESSION['id'] = $username;
				$res = $db->query("SELECT * FROM staff WHERE staff_id = '$username'");
				$_SESSION['type'] = $res->fetch_assoc()['role'];
				header('Location: index.php?page=staff&controller=profile&action=index');
			}
			else 
			{
				$err = "Sai tài khoản hoặc mật khẩu";
				$data = array('err' => $err);
				$this->render('index', $data);
			}
		}
		else
		{
			$this->render('index');
		}
	}

	public function logout()
	{
		session_start();
		unset($_SESSION["idStudent"]);
		session_destroy();
		header("Location: index.php?page=staff&controller=login&action=index");
	}
}
