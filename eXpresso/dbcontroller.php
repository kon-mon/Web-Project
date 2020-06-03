<?php
class DBController
{
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "delivery";
	private $conn;
	
	function __construct()
	{
		$this->conn = $this->connectDB();
	}
	
	function connectDB()
	{
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		mysqli_query($conn,"SET CHARACTER SET utf8") or die(mysql_error());
		return $conn;
	}
	
	function runQuery($query)
	{
		$result = mysqli_query($this->conn,$query) or die(mysql_error());
		while($row=mysqli_fetch_assoc($result))
		{
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function selectQuery($query) 
	{
		$result = mysqli_query($this->conn,$query) or die(mysql_error());
		$row = mysqli_fetch_array($result);
		return $row;
	}
	
	function updateQuery($query) 
	{
		$result = mysqli_query($this->conn,$query) or die(mysql_error());
		return $result;
	}
	
	function insertQuery($query) 
	{
		mysqli_query($this->conn,$query) or die(mysql_error());
		$result = mysqli_insert_id($this->conn);
		return $result;
	}
	
	function numRows($query)
	{
		$result  = mysqli_query($this->conn,$query) or die(mysql_error());
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>