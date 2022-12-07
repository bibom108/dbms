<?php
require_once('controllers/student/base_controller.php');
require_once('models/user.php');

class LoginController extends BaseController
{
	function __construct()
	{
		$this->folder = 'login';
	}

	public function index()
	{
		session_start();
		if (isset($_SESSION['idStudent']))
		{
			header('Location: index.php?page=student&controller=layouts&action=index');
		}
		else if (isset($_POST['submit']))
		{
			$username = $_POST['username'];
			$password = $_POST['pwd'];
			unset($_POST);
			$check = User::validation($username, $password);
			if ($check == 1)
			{
				$_SESSION['idStudent'] = $username;
				header('Location: index.php?page=student&controller=layouts&action=index');
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
		header("Location: index.php?page=student&controller=login&action=index");
	}
}
