<?php
include('php-barcode.php');
require('fpdf.php');

if( isset($_POST) ){
	
	//form validation vars
	$formok = true;
	$errors = array();
	
	//form data
	$code = $_POST['code'];	
	//$code2 = $_POST['code2'];
	
	//validate form data
	
	//validate name is not empty
	if(empty($code)){
		$formok = false;
		$errors[] = "No haz ingresado el codigo";
	}
	
	
	//what we need to return back to our form
	$returndata = array(
		'posted_form_data' => array(
			'code' => $code,
		),
		'form_ok' => $formok,
		'errors' => $errors
	);
		
	
	//if this is not an ajax request
	if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'){
		//set session variables
		session_start();
		$_SESSION['cf_returndata'] = $returndata;
		
		//redirect back to form
		header('location: ' . $_SERVER['HTTP_REFERER']);
	}
}
