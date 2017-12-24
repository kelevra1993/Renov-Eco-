<?php session_start() ; ?>
<?php include("includes/connect.php") ;  ?>
<?php include("includes/functions.php") ;  ?>
<?php confirm_logged_in(); ?>
<?php $com = find_com_by_id($_GET["Id"]) ;
if(!$com){
redirect_to("admin.php");//com missing or invalid
}

$id = $com["Id"] ;
$query = "DELETE FROM coms WHERE Id='{$id}' LIMIT 1 ;" ;
$result = mysqli_query($connection, $query);

if($result && mysqli_affected_rows($connection)>=0){
$_SESSION["message"]="Le Commentaire a été effacé." ;
redirect_to("admin.php");} 
else{
$_SESSION["deletion"]= "Tentative echouée."; 
redirect_to("admin.php");
}
 ?>
