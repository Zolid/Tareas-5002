<?php
class DbConfig {
	private static $db_name = "tarea2";
	private static $db_user = "cc5002";
	private static $db_pass = "cc5002";
	private static $db_host = "localhost";

	public static function getConnection() {
		$mysqli = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);

		$mysqli->set_charset("utf8"); 
		return $mysqli;
	}
} 
?>