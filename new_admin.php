<?php session_start() ; ?>
<?php include("includes/connect.php") ;  ?>
<?php include("includes/functions.php") ;  ?>
<?php $errors = array(); ?>
<?php confirm_logged_in(); ?>
<?php
$username="";
if (isset($_POST['submit'])){

	$required_fields = array("username", "password");
		validate_presences($required_fields);
	$fields_with_max_lengths= array("username"=> 30);
		validate_max_lengths($fields_with_max_lengths);
		$username=isset($_POST['username']) ? $_POST['username'] :"";
if (empty($errors)){

$username = mysql_prep($_POST["username"]);
$password = password_encrypt($_POST["password"]);

$query = "INSERT INTO admins(" ;
$query .=" username, password" ; 
$query .=") VALUES (";
$query .=" '{$username}','{$password}'";
$query .=")" ;
$result = mysqli_query($connection, $query);

if($result){
$_SESSION["message"] = "Administrateur crée." ;
redirect_to("manage_admins.php");}
else{
$_SESSION["fail"]= "Tentative echouée." ;
}
}
}else{//probably a get request//end: if (isset($_POST['submit']))
 }
 ?>
 <?php include("includes/main.php") ?>
<body>
<div class= "container">
<a class="logo" href="index.php"><img class="logo" src="images/Renovecoplus.png" alt="Accueil" /></a>
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
<div class="first-base">
	<div class="stay">

 <h2>Je Suis une Salope</h2>
<div class="check"><?php echo form_errors($errors); ?></div>

 <form action="new_admin.php" method="post">
<ul class="quality quality2"> 
<li><h5>Username : </h5><input class="input" type="text" name="username" value="<?php echo htmlentities($username) ; ?>" /></li>
<li><h5>Password : </h5><input class="input" type="password" name="password" value="" /></li></ul><br>
<p><input class="post post2" type="submit" name="submit" value="Créer" />
 </form>
 <br>
 <a class="post decline decline2" href="manage_admins.php">Annuler</a>
 
</div>
</div>
</div>
</body>
</html>

 
 
 
 
 
 
 
 