<?php
include_once ("Utli.php");

include_once ("validate.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = strip_tags($_POST["email"]);
	$password = strip_tags($_POST["password"]);
	session_unset();
	$validate = new validate();
	$dataToValidate = ["email" => $email, "password" => $password];
	$mayBeEmpty = $validate->checkIfEmpty($dataToValidate);
	foreach($dataToValidate as $key => $value) {
		if ($mayBeEmpty[$key] === true) { // if $mayBeEmpty["email"] === ture -- empty --
			$_SESSION[$key] = "empty"; // set the $_SESSION["email"] = "empty"
			$_SESSION["errors"] = true;
		}
	}

	if (isset($_SESSION["errors"])) {
		header("location: ../login.php");
	}
	else {
		if (!$validate->isEmail($email)) {
			$_SESSION["invalidEmail"] = true;
			$_SESSION["errors"] = true;

			// if the email is invaled we will return the user to the login page

			header("location: ../login.php");
		}
		else {
			$userLogin = new Utli();
			$userLogin->login($email, $password);
			if (isset($_SESSION["wrongCredentials"])) header("location: ../login.php");
		}
	}
}
