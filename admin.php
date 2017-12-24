<?php session_start() ; ?>
<?php include("includes/connect.php") ;  ?>
<?php include("includes/functions.php") ;  ?>
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
	<p class="indication"><?php if(isset($_SESSION["message"])){echo htmlentities($_SESSION["message"]);}
	$_SESSION["message"]=null ;  ?></p>
	<p class="indication indication2"><?php if(isset($_SESSION["deletion"])){echo htmlentities($_SESSION["deletion"]);}
	$_SESSION["deletion"]=null ;  ?></p>
			<summary><h1>
				Commentaires Postés
					</h1>
			</summary>
						<?php 
				$query ="SELECT * FROM coms WHERE Visibility='0' ORDER BY Id DESC" ; 

				$result=mysqli_query($connection, $query) ;

				while($com=mysqli_fetch_assoc($result)){
				$id=$com['Id'];
				echo "<div class=\"comment\">
				Date de Publication : " .htmlspecialchars($com["Date"])."<br>
				Ce commentaire vient de ".htmlspecialchars($com["Nom"])." ".htmlspecialchars($com["Prenom"])."<br> Il a estimé que la qualité de la prestation était ".htmlspecialchars($com["Quality"])."<br>
				Son numero de Télephone est 0".htmlspecialchars($com["Telephone"]).", son adresse-mail est ".htmlspecialchars($com["Adresse_mail"])." et il loge actuellement au ".htmlspecialchars($com["Adresse"])." <br> Voici Son Commentaire : "
			.htmlspecialchars($com["Comment"]).
				"</div> <a class=\"post\" href=\"authorize_com.php?Id=".htmlspecialchars($com["Id"])."\"> Autoriser</a>
			<a class=\"post decline\" href=\"delete_com.php?Id=".htmlspecialchars($com["Id"])."\" onclick=\"return confirm(\'are you sure ?\');\"> Supprimer</a>";}
			?>			
			<summary><h1>
				Les Utilisateurs
					</h1>
			</summary>
			<br><a class="post post3"href="manage_admins.php"> Gérer les admins</a>
		<summary><h1>
				 Commentaires Visibles
					</h1>
			</summary>
						<?php 
				$query ="SELECT * FROM coms WHERE Visibility='1' ORDER BY Id DESC" ; 

				$result=mysqli_query($connection, $query) ;

				while($com=mysqli_fetch_assoc($result)){
				$id=$com['Id'];
				echo "<div class=\"comment\">
				Date de Publication : " .htmlspecialchars($com["Date"])."<br>
				Ce commentaire vient de ".htmlspecialchars($com["Nom"])." ".htmlspecialchars($com["Prenom"])."<br> Il a estimé que la qualité de la prestation était ".htmlspecialchars($com["Quality"])."<br>
				Son numero de Télephone est 0".htmlspecialchars($com["Telephone"]).", son adresse-mail est ".htmlspecialchars($com["Adresse_mail"])." et il loge actuellement au ".htmlspecialchars($com["Adresse"])." <br> Voici Son Commentaire : "
			.htmlspecialchars($com["Comment"]).
				"</div> <a class=\"post\" href=\"de_authorize_com.php?Id=".htmlspecialchars($com["Id"])."\"> Cacher</a>
			<a class=\"post decline\" href=\"delete_com.php?Id=".htmlspecialchars($com["Id"])."\" onclick=\"return confirm(\'are you sure ?\');\"> Supprimer</a>";}
			?>			
	</div>
</div>
</div>
</body>
</html>