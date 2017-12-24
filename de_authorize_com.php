<?php session_start() ; ?>
<?php include("includes/connect.php") ;  ?>
<?php include("includes/functions.php") ;  ?>
<?php $errors = array(); ?>
<?php confirm_logged_in(); ?>
<?php 
$com = find_com_by_id($_GET["Id"]) ;

if(!$com){
redirect_to("admin.php");//com missing or invalid
}
 ?>
<?php 
$id = $com["Id"] ;

$query = "UPDATE coms SET " ;
$query .=" Visibility='0' " ; 
$query .=" WHERE Id='{$id}' ";
$query .=" LIMIT 1 ;" ; 
$result = mysqli_query($connection, $query);

if($result && mysqli_affected_rows($connection)>=0){
$_SESSION["message"] = "Le Commentaire a été caché." ;
redirect_to("admin.php");} 
else{
$_SESSION["message"]= "Tentative echouée."; 
redirect_to("admin.php");
}

 ?>
