<?php

$form = '
	<form action="mail.php" method="post">
		<p><label for="name">Votre nom : </label><input type="text" id="name" name="name" /></p>
		<p><label for="mail">Votre mail : </label><input type="text" id="mail" name="mail" /></p>
		<p><input type="submit" name="form1" value="Envoyer" /></p>
	</form>';

if (isset($_POST['form1'])) {

	if (isset($_POST['mail']) && isset($_POST['name'])) {

		$mail      = trim($_POST['mail']);
		$name      = trim($_POST['name']);
		$listOfIds = array(1, 2, 3);
		$bumper    = array("bouton central", "pied gauche", "pied droit");
		$randomId  = rand(0,  count($listOfIds) - 1);

		try {

		  $db = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql480901;charset=utf8', 'sql480901', 'hW9*zG6*');
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		  $db->query("SET NAMES 'utf8'");

			$u = $db->prepare('UPDATE emails SET Email_adress = :mail, Name = :name WHERE ID=:id');
			$u->bindValue(':mail', $mail, PDO::PARAM_STR);
			$u->bindValue(':name', $name, PDO::PARAM_STR);
			$u->bindValue(':id', $listOfIds[$randomId], PDO::PARAM_INT);

			$form = $u->execute() ? "
			<br />
			Bonjour ".htmlspecialchars($name).",<br />
			Votre email porte le numéro <big>".$listOfIds[$randomId].".<big><br />
			<br />
			Touchez le ".$bumper[$randomId]." d'HAL pour prendre votre photo.<br />
			<br />
			<img src='./images".$listOfIds[$randomId].".png' alt='Bumper' />" :
			"Une erreur est survenue, merci de ré-essayer dans un instant !";

		} catch(PDOException $error) {
			echo "PDO ERROR CODE: ".$error->getCode();
		}
	}
	exit();
}

?>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Inscription NAOmaton</title>
		<style>
			.nao {
				width:400px;
				height:250px;
				border: 2px solid #000000;
				position: absolute;
				margin: auto;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
			}
			.nao div {text-align: center;}
		</style>
	</head>
	<body>
		<a href="javascript:history.go(-1)">Retour à la galerie</a>
		<div class="nao">
			<div>
				Inscription Naomaton
			</div>
			<div>
			<?php echo $form; ?>
			</div>
		<div>
	</body>
</html>
