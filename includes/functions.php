<?php 

function redirect_to($location){
header("Location: " .$location);
exit ;
}
function mysql_prep($string){
global $connection ;
$prep_string=mysqli_real_escape_string($connection, $string) ;
return $prep_string ;
}
function confirm_query($result_set){
	if (!$result_set){
		die("Database query failed: " . mysql_error());
		}
}
function find_all_admins(){
global $connection ;
$query ="SELECT * " ;
$query .="FROM admins ";
$query .="ORDER BY username ASC ";
$admin_set=mysqli_query($connection, $query);
confirm_query($admin_set);
return $admin_set ;
}
function find_admin_by_id($admin_id){
		global $connection;
		$safe_admin_id = mysql_prep($admin_id);
		$query = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE id={$safe_admin_id} ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection,$query);
		confirm_query($admin_set);
	if ($admin = mysqli_fetch_assoc($admin_set)){
		return $admin;}
		else{
			return NULL;
			}
}
function has_presence($value){
return isset($value) && $value !=="";
}
function has_max_length($value, $max){
return strlen($value) <= $max;}
function has_inclusion_in($value, $set){
return in_array($value, $set) ;}
function form_errors($errors=array()){
$output = "";
if(!empty($errors)){
	$output .="<div>";
	$output .="Veuillez Corriger Les Erreurs Suivantes";
	$output .="<ul class=\"errors \">";
foreach ($errors as $key => $error) {
	$output .="<li>{$error}</li>";
	}
	$output .="</ul>";
	$output .="</div>";
	}
return $output ;
	}
function validate_max_lengths($fields_with_max_lengths){
	global $errors;
		foreach($fields_with_max_lengths as $field => $max){
			$value = trim($_POST[$field]);
		if(!has_max_length($value,$max)){
			$errors[$field] = ucfirst($field) ." est trop long";}
	}
}
function validate_presences($required_fields){
	global $errors;
		foreach($required_fields as $field){
		$value=trim($_POST[$field]);
		if(!has_presence($value)){
		$errors[$field] =ucfirst($field)." ne peut pas être vide";}
		}
}
function has_min_length($value,$min){
return strlen($value) >= $min;
}
function validate_min_lengths($fields_with_min_lengths){
	global $errors;
		foreach($fields_with_min_lengths as $field => $min){
			$value = trim($_POST[$field]);
		if(!has_min_length($value,$min)){
			$errors[$field] = ucfirst($field) ." est trop court";}
	}
}
function password_encrypt($password){
$hash_format="$2y$10$" ;
$salt_length = 22 ;
$salt=generate_salt($salt_length) ;
$format_and_salt = $hash_format . $salt ;
$hash = crypt($password, $format_and_salt);
return $hash ;
}
function generate_salt($length){
	$unique_random_string=md5(uniqid(mt_rand(), true));
	$base64_string =base64_encode($unique_random_string);
	$modified_base64_string=str_replace('+', '.', $base64_string);
	$salt=substr($modified_base64_string, 0, $length);
return $salt ;}
function password_check($password, $existing_hash){
$hash =crypt($password,$existing_hash);
if ($hash === $existing_hash){
return true ;
}else{
return false ;
}
}
function find_admin_by_username($username){
		global $connection;
		$safe_username = mysql_prep($username);
		$query = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE username='{$safe_username}' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection,$query);
		confirm_query($admin_set);
	if ($admin = mysqli_fetch_assoc($admin_set)){
		return $admin;}
		else{
			return NULL;
			}}
function attempt_login($username,$password){
$admin = find_admin_by_username($username);
	if($admin){
		if( password_check($password, $admin["password"])){
			return $admin;}
		else{
		return false;}
	}
	else{
		return false ;}
}
function confirm_logged_in(){
if(!isset($_SESSION['admin_id'])){
redirect_to("login.php") ;
}}
function find_all_coms(){
global $connection ;
$query ="SELECT * " ;
$query .="FROM coms ";
$query .="ORDER BY Id ASC ";
$com_set=mysqli_query($connection, $query);
confirm_query($com_set);
return $com_set ;
}
function find_com_by_id($com_id){
		global $connection;
		$safe_com_id = mysql_prep($com_id);
		$query = "SELECT * ";
		$query .= "FROM coms ";
		$query .= "WHERE Id={$safe_com_id} ";
		$query .= "LIMIT 1";
		$com_set = mysqli_query($connection,$query);
		confirm_query($com_set);
	if ($com = mysqli_fetch_assoc($com_set)){
		return $com;}
		else{
			return NULL;
			}
}


?>