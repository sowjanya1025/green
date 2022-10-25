<?php
require_once('config.php');

class databaseconnection
{
	private $hosts = DB_HOST;
	private $dbnames =DB_DATABASE ;
	private $user= DB_USER;
	private  $pass = DB_PASSWORD ;
	
	private $conn;
	private $result;
	
	public function __construct()
	{
		$this->conn = new mysqli($this->hosts,$this->user,$this->pass,$this->dbnames);
		if($this->conn->connect_error)
		{	
			echo "Connection failed".$this->conn->connect_error;
		}else
		{
			//echo "connection estblished";
		}
		//return $this->conn;
	}
	
	public function getSqlQuery($query)
	{
		$this->result =  $this->conn->query($query);
		//return $this->result;
		
	}
	public function getSqlNumber()
	{
		//$this->result = $this->conn->query($query);
		return $this->result->num_rows;
		
	}
	 public function getSqlFetchdata()
	 {
	 	return $this->result->fetch_assoc();
	 }
	
}
class  sanitizeforminputs
{
	public $data;
	public function __construct($forminputs)
	{
		$this->data = $forminputs;
		
		$this->data = trim($this->data);
		$this->data = stripslashes($this->data);
		$this->data = htmlspecialchars($this->data);
		//return $this->data;
	}
}
?>