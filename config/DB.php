<?php 

/**
 * DataBase connection class
 */

class DB
{
	private static $host = '';//set host
	private static $dbname = '';//set dbname
	private static $user = '';//set user
	private static $pass = '';//set password
	private static $opt = [
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
						]; 
	private static $conn;

	public static function getConnect()
	{
		$myhost = self::$host;
		$mydbname = self::$dbname;
		$myuser = self::$user;
		$mypass = self::$pass;
		$myopt = self::$opt;

		return self::$conn = new PDO("mysql: host=$myhost; dbname=$mydbname; charset=utf8", $myuser, $mypass, $myopt);
	}
}