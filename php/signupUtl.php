<?php
// no need to start the seesion here because we already done that inside the Utli.php
include_once("Utli.php");
include_once("validate.php");

// This means if the request is POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// removing html tags  using  strip_tags or use htmlspecialchars($_POST["name"]) or htmlentities($_POST["name"])
	$name = strip_tags($_POST["name"]);
	$email = strip_tags($_POST["email"]);
	$password = strip_tags($_POST['password']);
	$passwordC = strip_tags($_POST['confirmPassword']);
	session_unset(); // because we will store the erros in the session, so we need to unset the seesion to store the current errors
	// the old data to display it again in the input, if the user provided a wrong data so the user won't type every thing again
	$_SESSION["oldname"] = $name; // we will use if in oldValue function
	$_SESSION["oldemail"] = $email; // we will use if in oldValue function
	// the variables for storing the errors
	$errEame = $errEmail = $errPassword  = null;
	// check if the password is not equal to confirm Password
	// if not equal we will store that in the session under invalidPassword
	// and set the session errors to true -- this will be user in the signup page  to check if ther is an error --
	if($password !== $passwordC) {
		$_SESSION["invalidPassword"] = "invaled";
		$_SESSION["errors"] = true;
	}
	$validate = new validate();
	// isEmail will return true if the given data is email!
	// if the provided data is not a email we will sotre that in the sesstion and set errors to true
	if(!$validate->isEmail($email)){
		$_SESSION["invalidEmail"] = "invaled";
		$_SESSION["errors"] = true;
	}
	// isUnique will return true if the name does not exist in our users table 
	// if the provided data is not unique we will sotre that in the sesstion and set errors to true
	if(!$validate->isUnique($name)){
		$_SESSION["notUniqueName"] = "not Unique";
		$_SESSION["errors"] = true;	
	}
	// smae as above but for the size of the password
	// if you want to check for special characters or numbers there is a functions for them inside the validate class
	// the code then will look something like this 
	/*
		if (!$validate->specialChar($password)) error
		if (!$validate->foundNumber($password)) error
	*/
	if ($validate->min($password, 7)) {
		$_SESSION["passwordMinError"] = "lower than the min";
		$_SESSION["errors"] = true;		
	}
	if ($validate->max($password, 20)) {
		$_SESSION["passwordMaxError"] = "higher than the min";
		$_SESSION["errors"] = true;		
	}
	
	$dataToValidate = [
		"name" => $name,
		"email" => $email,
		"password" => $password
	];
	// sending the user data to the checkIfEmpty, that determine if any of the is empty
	$mayBeEmpty = $validate->checkIfEmpty($dataToValidate);

	foreach ($dataToValidate as $key => $value) {

		if($mayBeEmpty[$key] === true) { // if $mayBeEmpty["email"] === ture -- empty --
			$_SESSION[$key] = "empty"; // set the $_SESSION["email"] = "empty"
			$_SESSION["errors"] = true; 
		}
	}
	
	if(isset($_SESSION["errors"])) header("location: ../SignUp.php"); // change the user location if there is an error
	else{
		$userSignup = new Utli();
		if(!$userSignup->signup($name, $email, $password)){ // if the signup function returns false this means that the user already exists
			$_SESSION["errors"] = true;
			$_SESSION["userExist"] = true;
			header("location: ../SignUp.php");
		} 
	}
	
}

// this function to get the old value so the user do not fill the name and email again !
function oldValue($name){
	return isset($_SESSION["old{$name}"]) ?  $_SESSION["old{$name}"] : null;
}