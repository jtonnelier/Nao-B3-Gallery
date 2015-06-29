<?php

if (isset($_POST['form1'])) {

	if (isset($_POST['mail']) && isset($_POST['name'])) {

		$email  = trim($_POST['email']);
		$name   = trim($_POST['name']);
		$randId = rand(0, array(68, 130, 170, 187) - 1);

		try {

		  $db = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql480901;charset=utf8', 'sql480901', 'hW9*zG6*');
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		  $db->query("SET NAMES 'utf8'");

			$u = $db->prepare('UPDATE emails SET Email_adress = :mail, Name = :name WHERE ID=:id');
			$u->bindValue(':mail', $mail, PDO::PARAM_STR);
			$u->bindValue(':name', $name, PDO::PARAM_STR);
			$u->bindValue(':id', $randId, PDO::PARAM_INT);
			$u->execute();

			echo "
			Bonjour ".htmlspecialchars($name).",<br />
			Votre email porte le numéro : ".$randId.".<br /><br />
			Merci d'indiquer à HAL l'image :";

		} catch(PDOException $error) {
			echo "PDO ERROR CODE: ".$error->getCode();
		}
	}
	exit();
}

?>

<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
		<form action="mail.php" method="post">
			<p><label for="name">Votre nom : </label><input type="text" id="name" name="name" /></p>
			<p><label for="mail">Votre mail : </label><input type="text" id="mail" name="mail" /></p>
			<p><input type="submit" name="form1" value="Envoyer" /></p>
		</form>
	<body>
<html>
