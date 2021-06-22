<?php

class MySQLDB{
	protected $servername;
	protected $username;
	protected $password;
	protected $dbname;

	protected $db_connection;

	public function __construct($servername, $username, $password, $dbname){
		$this->servername = $servername;
		$this->username = $username;
		$this->password = $password;
		$this->dbname = $dbname;
	}

	public function openConnection(){
		//create connection
		$this->db_connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

		//check connection
		if($this->db_connection->connect_error){
			die('Could not connect to '.$this->servername.' server');
		}
	}

	public function executeSelectQuery($sql){
		$this->openConnection();
		$query_result = $this->db_connection->query($sql);
		$result = [];
		if($query_result != false && $query_result->num_rows > 0){
			//output data of each row
			while($row = $query_result->fetch_assoc()){
				$result[] = $row;
			}
		}

		$this->closeConnection();
		return $result;
	}

	public function executeNonSelectQuery($sql){
		$this->openConnection();
		$query_result = $this->db_connection->query($sql); //true or false
		$this->closeConnection();
		return $query_result;
	}

	public function closeConnection(){
		$this->db_connection->close();
	}

	public function escapeString($realname){
		$mysqli = new mysqli("localhost","root","","tubes");
		$escapedname = $mysqli->real_escape_string($realname);

		return $escapedname;
	}

	public function insertElement($sql){
		$this->openConnection();

		if($this->db_connection->query($sql) === true){
			echo "New record created successfully";
		}else{
			echo "Error";
		}

		return true;
	}

	public function updateQuery($sql){
		$this->openConnection();
		if($this->db_connection->query($sql) === true){
			return true;
		}else{
			return false;
		}
	}

}

?>