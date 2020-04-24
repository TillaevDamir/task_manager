<?php 

require_once ROOT."/config/DB.php";

class Tasks
{
	public static function countAllTasks()
	{
		$stmt = DB::getConnect()->query('SELECT COUNT(*) FROM tasks');
		return $tasks = $stmt->fetchColumn();
	}

	public static function getAll(array $limit)
	{
		$stmt = DB::getConnect()->prepare("SELECT * FROM tasks ORDER BY id DESC LIMIT ?,?");
		$stmt->bindParam(1, $limit['offset'], PDO::PARAM_INT);
		$stmt->bindParam(2, $limit['limit'], PDO::PARAM_INT);
		$stmt->execute();
		return $data = $stmt->fetchAll();
	}

	public static function get($id)
	{
		$stmt = DB::getConnect()->prepare('SELECT * FROM tasks WHERE id=?');
		$stmt->bindParam(1, $id);
		$stmt->execute();
		return $result = $stmt->fetch();
	}

	public static function set($task, $desc)
	{
    	$stmt = DB::getConnect()->prepare("INSERT INTO tasks(tasks, description) VALUES (?, ?)");
    	$stmt->bindParam(1, $task);
    	$stmt->bindParam(2, $desc);
    	$stmt->execute();
	}

	public static function delete($id)
	{
		$stmt = DB::getConnect()->prepare('DELETE FROM tasks WHERE id = ? LIMIT 1');
		$stmt->bindParam(1, $id);
		$stmt->execute();
	}

	public static function update(array $data)
	{
		$stmt = DB::getConnect()->prepare("UPDATE tasks SET tasks=:tasks, description=:description WHERE id=:id");
		$stmt->bindParam('id', $data['id']);
		$stmt->bindParam('tasks', $data['tasks']);
		$stmt->bindParam('description', $data['description']);
		$stmt->execute();
	}
}
