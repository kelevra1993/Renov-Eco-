<?php session_start() ; ?>
<?php include("includes/connect.php") ;  ?>
<?php include("includes/functions.php") ;  ?>
<?php confirm_logged_in(); ?>
<?php $admin = find_admin_by_id($_GET["id"]) ;
if(!admin){
redirect_to("manage_admins.php");//admin missing or invalid
}

$id = $admin["id"] ; 
$query = "DELETE FROM admins WHERE id={$id} LIMIT 1" ;
$result = mysqli_query($connection, $query) ; 

if($result && mysqli_affected_rows($connection)== 1){
$_SESSION["message"]="Administrateur effacé" ;
redirect_to("manage_admins.php");}
else{
$_SESSION["fail"]="Tentative echouée.";
redirect_to("manage_admins.php") ; 
}

 ?>
 