<?php session_start() ; ?>
<?php include("includes/connect.php") ;  ?>
<?php include("includes/functions.php") ;  ?>
<?php $errors = array(); ?>
<?php confirm_logged_in(); ?>
<?php 
$username="";
$admin = find_admin_by_id($_GET["id"]) ;
$username=isset($admin['username']) ? $admin['username'] :"";
$username=isset($_POST['username']) ? $_POST['username'] :$admin['username'];

if(!$admin){
redirect_to("manage_admins.php");//admin missing or invalid
}

 ?>
<?php 
if (isset($_POST['submit'])){
	$required_fields = array("username", "password");
		validate_presences($required_fields);
	$fields_with_max_lengths= array("username"=> 30);
		validate_max_lengths($fields_with_max_lengths);
		$username=isset($_POST['username']) ? $_POST['username'] :"";
if (empty($errors)){

$id = $admin["id"] ;
$username = mysql_prep($_POST["username"]);
$password = password_encrypt($_POST["password"]);

$query = "UPDATE admins SET " ;
$query .=" username='{$username}', " ; 
$query .=" password='{$password}' ";
$query .=" WHERE id='{$id}' ";
$query .=" LIMIT 1 ;" ; 
$result = mysqli_query($connection, $query);

if($result && mysqli_affected_rows($connection)==1){
$_SESSION["message"] = "Administrateur modifié." ;
redirect_to("manage_admins.php");} 
else{
$_SESSION["fail"]= "Administrateur non modifié."; 
}
}
}else{//probably a get request//end: if (isset($_POST['submit']))
 }
 ?>

<?php include("includes/main.php") ?>
<body>
<div class= "container">
<nav class="top-nav">

	<ul class="menu">
		<li><a href="index.php" title="" > Accueil </a> </li>
		<li><a href="Prestations.php" title="" > Prestations </a> </li>
		<li><a href="Travaux.php" title="" > Travaux </a> </li>
		<li><a href="Temoignages.php" title="" > Témoignages </a> </li>
		<li><a href="Nous contacter.php" title="" > Nous Contacter </a> </li>
		<li><a class="current" href="admin.php" title="" > Administrateur </a> </li>
	</ul>
	
</nav>
<a class="logo" href="index.php"><img class="logo" src="images/Renovecoplus.png" alt="Accueil" /></a>
<div class="first-base">
	<div class="stay">

 <h2>Modifier L'administrateur : <?php echo htmlentities($admin["username"]); ?></h2>
 <div class="check"><?php echo form_errors($errors); ?></div>
 <form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
<ul class="quality quality2">
 <li><h5>Username : </h5><input class="input" type="text" name="username" value="<?php echo htmlentities($username); ?>" /></li>
 <li><h5>Password : </h5><input class="input" type="password" name="password" value="" /></li></ul><br>
 <p><input class="post post2" type="submit" name="submit" value="Modifier" />
 </form>
 <br>
 <a class="post decline decline2" href="manage_admins.php">Annuler</a>
 
 </div>
</div>
</div>
</body>
</html>