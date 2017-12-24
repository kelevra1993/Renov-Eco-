<?php session_start() ; ?>
<?php include("includes/connect.php") ;  ?>
<?php include("includes/functions.php") ;  ?>
<?php $errors = array(); ?>
<?php 
$username="";
if (isset($_POST['submit'])){
		$required_fields = array("username", "password");
		validate_presences($required_fields);
		$username=isset($_POST['username']) ? $_POST['username'] :"";
if (empty($errors)){

$username=$_POST["username"] ; 
$password=$_POST["password"] ; 


$found_admin = attempt_login($username, $password);


if($found_admin){
$_SESSION["admin_id"] = $found_admin["id"] ;
$_SESSION["username"] = $found_admin["username"] ;
redirect_to("admin.php");}
else{
$_SESSION["message"]= "Les informations fournis ne correspondent pas" ;
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
		<h2>Connexion</h2><br>
		<div class="check"><p class="indication indication2"><?php if(isset($_SESSION["message"])){echo htmlentities($_SESSION["message"]);}
	$_SESSION["message"]=null ;  ?></p></div><br>
			<form action="login.php" method="post">
			Username : <input type="text" name="username" value="<?php echo htmlentities($username) ; ?>" />
			<br><br>Password : <input type="password" name="password" value="" /><p><input class="extend" type="submit" name="submit" value="Se Connecter" />
			</form>
			<br>
	</div>
</div>
</div>
</body>
</html>
 
 
 
 
 
 
 
 
 
 