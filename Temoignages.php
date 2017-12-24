<?php session_start() ?>
<?php include("includes/connect.php") ;  ?>
<?php include("includes/functions.php") ;  ?>
<?php include("includes/main.php") ?>

<?php $errors = array(); ?>

<?php 
$Nom="";
$Prenom="";
$Telephone="";
$Adresse_mail="";
$Adresse="";



if(isset($_POST['submit']))
{
	$_POST['Telephone'] = str_replace(" ", "", $_POST['Telephone'] );
	$required_fields = array("Nom", "Prénom", "Telephone","Adresse", "Adresse_mail","Commentaire");
	validate_presences($required_fields);
	$fields_with_min_lengths= array("Commentaire"=> 10,"Telephone"=>10);
	validate_min_lengths($fields_with_min_lengths);
	$fields_with_max_lengths= array("Telephone"=>10);
	validate_max_lengths($fields_with_max_lengths);
	$Nom=isset($_POST['Nom']) ? $_POST['Nom'] :"";
	$Prenom=isset($_POST['Prénom']) ? $_POST['Prénom'] :"";
	$Telephone=isset($_POST['Telephone']) ? $_POST['Telephone'] :"";
	$Adresse_mail=isset($_POST['Adresse_mail']) ? $_POST['Adresse_mail'] :"";
	$Comment=isset($_POST['Commentaire']) ? $_POST['Commentaire'] :"";
	$Adresse=isset($_POST['Adresse']) ? $_POST['Adresse'] :"";
if (empty($errors)){	
$Nom=mysql_prep($_POST['Nom']);
$Prenom=mysql_prep($_POST['Prénom']);
$Telephone=mysql_prep($_POST['Telephone']);
$Adresse=mysql_prep($_POST['Adresse']);
$Quality=mysql_prep($_POST['Quality']);
$Comment=mysql_prep($_POST['Commentaire']);
$Visibility= 0 ;

$query= "INSERT INTO coms(Nom,Prenom,Telephone,Adresse,Adresse_mail,Quality,Comment,Visibility,Date) 
		  VALUES ('$Nom','$Prenom',$Telephone,'$Adresse','$Adresse_mail','$Quality','$Comment',$Visibility,now())";
	$result = mysqli_query($connection, $query);
	if($result){
$_SESSION["message"]="Le Commentaire a été enregistré il ne reste plus que la confirmation de celle-ci"	;
redirect_to("Temoignages.php");}
	else{
$_SESSION["message"]="Le Commentaire est mal passé";
redirect_to("Temoignages.php");
	die("Database query failed.".mysqli_error($connection) ); 
	}
}}
else
{}
 ?>

<body>
<div class= "container">
<a class="logo" href="index.php"><img class="logo" src="images/Renovecoplus.png" alt="Accueil" /></a>
<nav class="top-nav">

	<ul class="menu">
		<li><a href="index.php" title="" > Accueil </a> </li>
		<li><a href="Prestations.php" title="" > Prestations </a> </li>
		<li><a href="Travaux.php" title="" > Travaux </a> </li>
		<li><a class="current" href="Temoignages.php" title="" > Témoignages </a> </li>
		<li><a href="Nous contacter.php" title="" > Nous Contacter </a> </li>
		<li><a href="admin.php" title="" > Administrateur </a> </li>
	</ul>
	
</nav>
<div class="first-base">
	<div class="stay"> 
		<h2>D'autres Nous Ont Fait Confiance Pourquoi Pas Vous ?</h2><br>
			<h3>Qu'avez vous pensé de la qualité de notre Prestation </h3><br>

	<form action="Temoignages.php" method="post">
		<ul class="quality">
				<li class="Excellent"><input type="radio" name="Quality" value="Excellente" checked>&nbsp Excellente</li>
				<li><input type="radio" name="Quality" value="Bonne" >&nbsp &nbsp Bonne</li>
				<li class="Médiocre"><input type="radio" name="Quality" value="Médiocre">&nbsp Médiocre</li>
				<li class="Mauvais"><input type="radio" name="Quality" value="Mauvaise" >&nbsp Mauvaise</li>
				<li class="TMauvais"><input type="radio" name="Quality" value="Très Mauvaise" >&nbsp Très Mauvaise</li>
		</ul>
	<br>
		<h4><br>Dites nous en plus : </h4>
		<p class="indication"><?php if(isset($_SESSION["message"])){echo htmlentities($_SESSION["message"]);}
$_SESSION["message"]=null ;  ?></p>
		<div class="check"><?php echo form_errors($errors); ?></div>
	<ul class="quality quality2">	
		<li><h5>Nom :</h5><input class="input" type="text" name="Nom" value="<?php echo htmlentities($Nom); ?>" placeholder="          Monteiro" >  </li>
		<li><h5>Prénom :</h5><input class="input" type="text" name="Prénom" value="<?php echo htmlentities($Prenom); ?>" placeholder="            Rafael" >  </li>
		<li><h5>Téléphone :</h5><input class="input" type="text" name="Telephone" value="<?php echo htmlentities($Telephone); ?>" placeholder="     06 XX XX XX XX" >  </li>
		<li><h5>Adresse :</h5><input class="input" type="text" name="Adresse" value="<?php echo htmlentities($Adresse); ?>"placeholder="10 avenue Emile Aillaud" > </li>
		<li><h5>Adresse-mail :</h5><input class="input" type="text" name="Adresse_mail" value="<?php echo htmlentities($Adresse_mail); ?>" placeholder="  renov-eco@orange.fr" > </li>
	</ul>
		<textarea class="area" type="Text" name="Commentaire" placeholder="N'hesitez pas à nous préciser ce que vous avez pensé de notre prestation..."><?php if(isset($Comment)){echo htmlentities($Comment);} ;  ?></textarea><br>
			<input class="post"type="submit" name="submit" value="Poster" >
			<input class="post decline" type="reset" name="reset" value="Annuler" onclick="return confirm('Etes Vous Sur ?');"  >
	</form><br> <br>		
			<?php 
				$query ="SELECT * FROM coms WHERE Visibility=1 ORDER BY Id DESC" ; 

				$result=mysqli_query($connection, $query) ;

				while($row=mysqli_fetch_assoc($result)){
				echo "<div class=\"comment\"><p class=\"left\">Date de Publication : " .htmlspecialchars($row["Date"]).
				"<br> Auteur : ".htmlspecialchars($row["Nom"])." ".htmlspecialchars($row["Prenom"]).
				"<br> Qualité de la Prestation : ".htmlspecialchars($row["Quality"])."<br>"
				.htmlspecialchars($row["Comment"])."</p>".
				"</div>" ;}
			?>


	</div>
</div>
</div>
</body>
</html>
<?php// mysqli_close($connection) ; ?>