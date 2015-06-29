<?php

if(isset($_POST['email']) && isset($_POST['email'])){
	$email = $_POST['email'];
	$name = $_POST['name'];
	$array_email_id = array(68, 130, 170, 187);
	$email_id = array_rand($array_email_id);
	$bdd = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql480901;charset=utf8', 'sql480901', 'hW9*zG6*');
	$request = "UPDATE emails SET Email_adress = ". $email .", Name=". $name ." WHERE ID=".$array_email_id[$email_id].";";
	$result = $bdd->exec($request);
	//print_r($result);
	echo "<html>
			<link rel=\"shortcut icon\" href=\"favicon.ico\" />
			<body>
				".$name." Votre email porte le numéro: ".$array_email_id[$email_id]." .
				Merci d'indiquer à HAL l'image: ".$request."
				
			<body>
		<html>";
}
else{
	echo"<html>
			<link rel=\"shortcut icon\" href=\"favicon.ico\" />
			<body>
				<form action=\"email.php\" method=\"post\">
					<p>Votre Nom : <input type=\"text\" name=\"name\" /></p>
					<p>Votre email : <input type=\"text\" name=\"email\" /></p>
					<p><input type=\"submit\" value=\"Envoyer\"></p>
				</form>
			<body>
		<html>";
}

?>