<?php 

require_once ROOT."/app/Models/Tasks.php";
require_once ROOT."/config/config.php";

class MainController
{
	public function index()
	{	
		$limit = 5;
		if(!isset($_GET['page'])) $page = 1; else $page = htmlspecialchars($_GET['page']);
		if(ctype_digit($page) === false) $page = 1;
		$tasks = Tasks::countAllTasks();
		$total = ceil($tasks / $limit);
		$offset = ($page - 1) * $limit;
		$this->lim['offset'] = $offset;
		$this->lim['limit'] = $limit;

		$data['title'] = "All tasks";
		$data['tasks'] = Tasks::getAll($this->lim);
		require ROOT."/views/index.php";
	}

	public function newTask()
	{
		if(!empty($_POST['task']) && $_POST['task'] != '' && !empty($_POST['desc']) && $_POST['desc'] != '')
		{
			$task = htmlspecialchars(trim($_POST['task']));
			$desc = htmlspecialchars(trim($_POST['desc']));

			if(Tasks::set($task, $desc))
			{
				$_SESSION['err'] = "Error!";
			}
			else
			{
				$_SESSION['msg'] = "SUCCESS!";
			}
			header('Location: index.php');
		}
		else
		{
			header('Location: index.php');	
		}
	}

	public function deleteTask()
	{
		if(!empty($_POST['id']))
		{
		    $id = $_POST['id'];
			
			if(Tasks::delete($id))
			{
				$_SESSION['err'] = "Error!";
			}
			else
			{
				$_SESSION['msg'] = "SUCCESS!";
			}
			header('Location: index.php');
		}
	}

	public function editTask()
	{
		if(!empty($_POST['id']))
		{
		    $id = $_POST['id'];
			$data['setTask'] = Tasks::get($id);
			$data['title'] = "Edit Task";
			$_SESSION['msg'] = "Редактировать";
			require ROOT."/views/edit_page.php";
		}
	}

	public function updateTask()
	{
		if(isset($_POST['update']))
		{
			if(isset($_POST['task']) && $_POST['task'] != '' && isset($_POST['desc']) && $_POST['desc'] != '')
			{
				$data['tasks'] = htmlspecialchars(trim($_POST['task']));
				$data['description'] = htmlspecialchars(trim($_POST['desc']));
				$data['id'] = $_POST['id'];

				if(Tasks::update($data))
				{
					$_SESSION['err'] = "Error!";
				}
				else
				{
					$_SESSION['msg'] = "SUCCESS!";
				}
				header('Location: index.php');
			}
		}
	}
}