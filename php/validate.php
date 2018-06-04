<?php


class validate{
	public  $host = "localhost";
	public  $userName = "root";
	public  $password = "";
	public  $database = "betelgeuse";
	// this function will return an array with the attribute name as a key and the value will be set to true if the variable is empty otherwise will be false
	// using this way will us write less code
	// and it's reusable anywhere
	public function checkIfEmpty($arr): array{
		$validatedData = [];
		foreach ($arr as $key => $var) {
			if(empty($var)) $validatedData[$key] = true;
			else $validatedData[$key] = false;
		}
		return $validatedData;
	}
	// to check if the given email is email
	public function isEmail($email): bool{
		return  filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	// this function checks if the user neme provided id unique 
	public function isUnique($data): bool{
		$con = new mysqli($this->host, $this->userName, $this->password, $this->database);
		$sql = "SELECT * FROM users WHERE name = ?";
		$query = $con->prepare($sql);
		$query->bind_param("s", $data);
		$query->execute();
		$result = $query->get_result();
		if($result->num_rows > 0) return false;
		else return true;
	}

	public function min($string, $min) : bool{
		return (strlen($string) < $min) ? true : false;
		/*
			it's equivalent to 
			if(strlen($string) < $min ) return true;
			else return false
		*/
	}

	public function max($string, $max) : bool{
		return (strlen($string) > $max) ? true : false;
	}
	// check if the password have at least one special character
	public function specialChar($string) : bool{
		return preg_match("/['^£$%&*()}{@#~?><>,|=_+!-]/", $string);
	}
	// check if the password have at least one number
	public function foundNumber($string) : bool {
		return preg_match('~[0-9]+~', $string);
	}
}