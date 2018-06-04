<?php
session_start();
// var_dump($_SESSION["user"]);

class Utli{
	public  $host = "localhost";
	public  $userName = "root";
	public  $password = "";
	public  $database = "betelgeuse";

	public  function signup($name, $email, $password) :bool{
		if(!$this->userAlreadyExist($email)){
			return $this->insertUser($name, $email, $password);
		}else return false;
	}

	public function insertUser($name, $email, $password):bool{
			$myConnection = new mysqli($this->host, $this->userName, $this->password, $this->database);
			if($myConnection->connect_error) $this->connectionError();
			$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
			$signup = $myConnection->prepare($sql);
			$newPassword = password_hash($password, PASSWORD_BCRYPT);
			$signup->bind_param("sss", $name, $email, $newPassword);
			if($signup->execute()){
				$signup->close();
				$myConnection->close();
				$this->setUserSession($name, $email);
				return true;
			}else{
				echo "ERROR";
				return false;
			}
	}

	public function setUserSession($name, $email){

		session_regenerate_id();
		session_unset();
		$_SESSION["user"] = [
			"id" => $this->getUserId($email),
			"name" => $name,
			"email" => $email
		];
		
		// TODO redirect the user
		var_dump($_SESSION["user"]);
		echo "Every thing works!";
	}

	public function getUserId($email):int{
		$con = new mysqli($this->host, $this->userName,
		 $this->password, $this->database);
		if($con->connect_error) $this->connectionError();
		$sql = "SELECT id FROM users WHERE email = ?";
		$query = $con->prepare($sql);
		$query->bind_param("s", $email);
		$query->execute();
		$result = $query->get_result();
		$row = mysqli_fetch_assoc($result);
		$id = $row["id"];
		return $id;
	}

	public  function userAlreadyExist($email): bool{
		$con = new mysqli($this->host, $this->userName,
		 $this->password, $this->database);
		if($con->connect_error) $this->connectionError();
		$sql = "SELECT * FROM users WHERE email = ?";
		$query = $con->prepare($sql);
		$query->bind_param("s", $email);
		$query->execute();
		$result = $query->get_result();
		$con->close();
		$query->close();
		if($result->num_rows > 0) return true;
		else return false;
	}

	public function login($email, $password){
		 $con = new mysqli($this->host, $this->userName,
		 $this->password, $this->database);
		 if($con->connect_error) $this->connectionError();
		 $userExists  = $this->userAlreadyExist($email);
		 if($userExists){
		 	// now check for the password
		 	if(password_verify($password,$this->getTheUserPassword($email))){
		 		// the Password is valid
		 		$this->setUserSession($this->getTheUserName($email), $email);
		 	}else{
		 		// the Password is invalid
		 		$_SESSION["wrongCredentials"] = "wrong credentials";
		 	}
		 }else{
		 		$_SESSION["wrongCredentials"] = "wrong credentials";
		 }
	}

	public function getTheUserPassword($email) : string{
		 $con = new mysqli($this->host, $this->userName,
		 $this->password, $this->database);
		 if($con->connect_error) $this->connectionError();
		 $sql = "SELECT password FROM users WHERE email = ?";
		 $query = $con->prepare($sql);
		 $query->bind_param("s", $email);
		 $query->execute();
		 $result = $query->get_result();
		 $row = mysqli_fetch_assoc($result);
		 $password = $row["password"];
		 return $password;
	} 

	public function connectionError(){
		$_SESSION["connection_error"] = "true";
		header("location: login.php");
	}

	public function getTheUserName($email): string{
		 $con = new mysqli($this->host, $this->userName,
		 $this->password, $this->database);
		 if($con->connect_error) $this->connectionError();
		 $sql = "SELECT name FROM users WHERE email = ?";
		 $query = $con->prepare($sql);
		 $query->bind_param("s", $email);
		 $query->execute();
		 $result = $query->get_result();
		 $row = mysqli_fetch_assoc($result);
		 $name = $row["name"];
		 return $name;
	}

}