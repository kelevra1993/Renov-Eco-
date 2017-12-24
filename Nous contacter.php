<?php session_start() ;  ?>
<?php $errors = array(); ?>
<?php include("includes/functions.php") ;  ?>
<?php require_once("phpmailer/class.phpmailer.php") ;
require_once("phpmailer/class.smtp.php") ;
require_once("phpmailer/language/phpmailer.lang-en.php") ; ?>
<?php 
$Question="";
$Adresse_mail="";
$Telephone="";

if(isset($_POST['submit']))
{
$_POST['Telephone'] = str_replace(" ", "", $_POST['Telephone'] );
$required_fields = array("Adresse_mail","Question","Telephone");
validate_presences($required_fields);
$fields_with_min_lengths= array("Question"=> 10,"Telephone"=>10);
validate_min_lengths($fields_with_min_lengths);
$fields_with_max_lengths= array("Telephone"=>10);
validate_max_lengths($fields_with_max_lengths);
$Telephone=isset($_POST['Telephone']) ? $_POST['Telephone'] :"";
$Adresse_mail=isset($_POST['Adresse_mail']) ? $_POST['Adresse_mail'] :"";
$Question=isset($_POST['Question']) ? $_POST['Question'] :"";

if (empty($errors)){
$to_name= "Renovecoplus" ;
$to= "renov-eco@orange.fr" ;
$subject="Question Prestation " ;
$message="Question de la part de ".$Adresse_mail." Son numero de Téléphone est $Telephone et sa question est la suivante $Question" ;
$from_name="Renovecoplus" ;
$from="Renovecoplus" ;

$mail= new PHPmailer();
$mail->IsSMTP();
// $mail->SMTPDebug  = 2; renov-eco@orange.fr
  
$mail->Host='ssl://smtp.gmail.com';
$mail->Port=465;
$mail->SMTPAuth=true;

$mail->Username="Renovecoplus@gmail.com";
$mail->Password="renovecoplus2015";

$mail->Fromname=$from_name;
$mail->From=$from;
$mail->AddAddress($to, $to_name);
$mail->Subject=$subject;
$mail->Body=$message;

$result= $mail->Send() ;

if($result){
$_SESSION["message"]="La Question a été envoyée, on essayera de vous répondre au plus vite"	;
redirect_to("Nous contacter.php");}
// echo $result ? "sent" : "fail".$mail->ErrorInfo ;

else
{$_SESSION["message"]="La Question n'a pas été envoyée".$mail->ErrorInfo	;
redirect_to("Nous contacter.php");}}
else{}}

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
		<li><a class="current" href="Nous contacter.php" title="" > Nous Contacter </a> </li>
		<li><a href="admin.php" title="" > Administrateur </a> </li>
	</ul>
	
</nav>
<div class="first-base">
<div class="stay">
	<div class="comment comment1"> <h2>Des Questions sur des Devis, ou autre ?</h2><br>
	<h3>N'Hésitez pas </h3><br>
	</div>
	
			<p class="indication"><?php if(isset($_SESSION["message"])){echo htmlentities($_SESSION["message"]);}
$_SESSION["message"]=null ;  ?></p>
		<div class="check"><?php echo form_errors($errors); ?></div>
		<ul class="quality quality2 quality3">	
<form action="Nous contacter.php" method="post">


		<li><h5>Adresse-mail :</h5><input class="input" type="text" name="Adresse_mail" value="<?php echo htmlentities($Adresse_mail); ?>" placeholder="  renov-eco@orange.fr" > </li>
		<li><h5>Téléphone :</h5><input class="input" type="text" name="Telephone" value="<?php echo htmlentities($Telephone); ?>" placeholder="     06 XX XX XX XX" >  </li>
	</ul>

		<textarea class="area" type="Text" name="Question" placeholder="N'hésitez pas à poser des questions sur des éventuels travaux que vous voudriez entreprendre"><?php if(isset($Question)){echo htmlentities($Question);} ;  ?></textarea>

		<input class="post"type="submit" name="submit" value="Envoyer" >
		<input class="post decline" type="reset" name="reset" value="Annuler" onclick="return confirm('Etes Vous Sur ?');"  >
</form><br>
	<img class="work" src="images/images-travaux/work.JPG" />
	<h3>Vous pouvez aussi nous contacter directement avec les informations suivantes</h3>
	<br>
	<div class="abs">
	<p>
	Adresse : 10 avenue Emile Aillaud 
	</p>
	<p>
	Code Postal :91350 GRIGNY
	</p>
	<p>
	Tel : 06.64.43.41.55
	</p>
	<p>
	Fax : 09.59.73.41.06
	</p>
	<p>
	Email : renov-eco@orange.fr
	</p>
</div><br>
<h3>Voici une carte pour vous aider à nous trouver</h3>
<div class="map"><iframe class="map"src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1318.0204129221672!2d2.38149425728052!3d48.64733418761041!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5dee6a7efca07%3A0xa5ac5b3654125085!2s10+Avenue+Emile+Aillaud%2C+91350+Grigny!5e0!3m2!1sfr!2sfr!4v1435154111575" 
width=400px height=400px frameborder="0" style="border: 1px solid black ; position : relative ;" allowfullscreen>
</iframe>
</div>
</div>
</div>
</div>
</body>
</html>