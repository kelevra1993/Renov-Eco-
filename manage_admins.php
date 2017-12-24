<?php session_start() ; ?>
<?php include("includes/connect.php") ;  ?>
<?php include("includes/functions.php") ;  ?>
<?php $admin_set=find_all_admins(); ?>
<?php confirm_logged_in(); ?>
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

<h2>Gérer Les Administrateurs</h2>
<p class="indication"><?php if(isset($_SESSION["message"])){echo htmlentities($_SESSION["message"]);}
$_SESSION["message"]=null ;  ?></p>
<p class="indication indication 2"><?php if(isset($_SESSION["fail"])){echo htmlentities($_SESSION["fail"]);}
$_SESSION["fail"]=null ;  ?></p>
<table>
	<tr>
		<th>Nom d'Utilisateur</th>
		<th>Actions</th>
	</tr>
	<?php while($admin=mysqli_fetch_assoc($admin_set)){
	?><tr>
		<td><?php echo htmlentities($admin["username"]); ?>  </td>
		<td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Modifier</a></td>
		<td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>" onclick="return confirm('are you sure ?');">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Effacer</a></td>		
	</tr>
	<?php } ?>
</table><br>
<a href="new_admin.php">Ajouter Un Nouvel Administrateur</a>
<hr />
	</div>
</div>
</div>
<body>
</html>