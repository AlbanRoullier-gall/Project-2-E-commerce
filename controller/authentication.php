<?php
 
require_once('model/model_media/connection_database.php'); 

function authentication(String $input_email, String $input_password){

	if (isset($input_email) && isset($input_password)) {
    	$email  = $input_email;
    	$password = $input_password;
	}

	$authentication = new Authentication($email, $password);
	$test = $authentication::$userValid;
  	if ($test!==TRUE){
		throw new Exception(sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',$email,$password));
	}
	else{
		$catalog_users = new CatalogUsers();
    	$user = $catalog_users ->select_user($email);
		$_SESSION['LOGGED_USER_NAME'] = $user['name_user'];
		setcookie(
			'LOGGED_USER_NAME',
			strval($user['name_user']),
			[
				'expires' => time() + 365*24*3600,
				'secure' => true,
				'httponly' => true,
			]
		);  
		$_SESSION['LOGGED_USER_FIRSTNAME'] = $user['firstname_user'];
		setcookie(
			'LOGGED_USER_FIRSTNAME',
			strval($user['firstname_user']),
			[
				'expires' => time() + 365*24*3600,
				'secure' => true,
				'httponly' => true,
			]
		);
		$_SESSION['LOGGED_USER_EMAIL'] = $user['email_user'];
		setcookie(
			'LOGGED_USER_EMAIL',
			strval($user['email_user']),
			[
				'expires' => time() + 365*24*3600,
				'secure' => true,
				'httponly' => true,
			]
		);
		$_SESSION['LOGGED_USER_ADDRESS'] = $user['address_user'];
		setcookie(
			'LOGGED_USER_ADDRESS',
			strval($user['address_user']),
			[
				'expires' => time() + 365*24*3600,
				'secure' => true,
				'httponly' => true,
			]
		);
		$_SESSION['LOGGED_USER_POSTAL_CODE'] = $user['postal_code_user'];
		setcookie(
			'LOGGED_USER_POSTAL_CODE',
			strval($user['postal_code_user']),
			[
				'expires' => time() + 365*24*3600,
				'secure' => true,
				'httponly' => true,
			]
		);
		$_SESSION['LOGGED_USER_CITY'] = $user['city_user'];
		setcookie(
			'LOGGED_USER_CITY',
			strval($user['city_user']),
			[
				'expires' => time() + 365*24*3600,
				'secure' => true,
				'httponly' => true,
			]
		);
		$_SESSION['LOGGED_USER_COUNTRY'] = $user['name_country'];
		setcookie(
			'LOGGED_USER_COUNTRY',
			strval($user['name_country']),
			[
				'expires' => time() + 365*24*3600,
				'secure' => true,
				'httponly' => true,
			]
		);
		$_SESSION['LOGGED_USER_PHONE_NUMBER'] = $user['phone_number_user'];
		setcookie(
			'LOGGED_USER_PHONE_NUMBER',
			strval($user['phone_number_user']),
			[
				'expires' => time() + 365*24*3600,
				'secure' => true,
				'httponly' => true,
			]
		);
		setcookie(
			'LOGGED_USER_PASSWORD',
			strval($user['password_user']),
			[
				'expires' => time() + 365*24*3600,
				'secure' => true,
				'httponly' => true,
			]
		);
		$_SESSION['LOGGED_USER_PICTURE'] = $user['image_profil_user'];
		setcookie(
			'LOGGED_USER_PICTURE',
			strval($user['image_profil_user']),
			[
				'expires' => time() + 365*24*3600,
				'secure' => true,
				'httponly' => true,
			]
		);
		$profilpicture = $_SESSION['LOGGED_USER_PICTURE'];
		header('Location:index.php');
		exit();
	}
	
	require('view/authenticationview.php'); 
}

