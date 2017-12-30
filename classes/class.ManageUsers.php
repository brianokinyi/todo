<?php
	//Include the connection
	include_once("class.database.php");

	//New Class to manageusers
	class ManageUsers {
		public $link;

		//Construct function
		function __construct () {
			$db_connection = new dbConnection(); //New instance of connection class
			$this->link = $db_connection->connect();
			return $this->link;
		}
		//Function to create a new user
		function registerUsers($username, $password, $ip_address, $time, $date) {
			//use prepared statements to avoid sql injections
			$query = $this->link->prepare ("INSERT INTO users (username, password, ip_address, reg_time, reg_date) 
			VALUES (?, ?, ?, ?, ?)");
			//Get passed parameters
			$values = array($username, $password, $ip_address, $time, $date);
			$query->execute($values);

			//Get number of queries that have been affected
			$counts = $query->rowCount();
			return $counts;
		}
	}

	//use class
	$users = new ManageUsers();
	echo $users->registerUsers('Bob', 'bob', '127.0.0.0', '12:00', '29-02-2017');
?>