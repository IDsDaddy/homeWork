<?php

	function dbConnTest() 
	{
		$server = "127.0.0.1";
		$user = "root";
		$pass = "";
		$db = "a5db";

		try 
		{
			$dbh = new PDO("mysql:host=$server;dbname=$db;charset=utf8mb4", $user, $pass);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return ($dbh);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

?>