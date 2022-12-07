<?php
require_once('controllers/student/base_controller.php');
require_once('models/user.php');

class MyCourseController extends BaseController
{
	function __construct()
	{
		$this->folder = 'mycourse';
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
	public function update() {
		
	}
	public function search(){
		$where = '';
		if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
			$_SESSION['course_filter'] = $_POST;
		  }
		if(!empty($_SESSION['course_filter'])){
			foreach($_SESSION['course_filter'] as $field =>$value){
				if(!empty($value)){
				$where .= (!empty($where)) ? " AND "."`".$field."` LIKE '%".$value."%'": "`".$field."` LIKE '%".$value."%'";
				}
			}
		}
	}
}