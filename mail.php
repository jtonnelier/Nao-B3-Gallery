<?php

$executed = false;
if (isset($_POST['form1'])) {

	if (isset($_POST['mail']) && isset($_POST['name'])) {

		$mail   = trim($_POST['mail']);
		$name   = trim($_POST['name']);
		$idList = array(1, 2, 3);
		$bumperCorrepondance = array("bouton central", "pied gauche", "pied droit");
		$randId = rand(0,  count($idList) - 1);

		try {

		  $db = new PDO('mysql:host=sql4.freemysqlhosting.net;dbname=sql480901;charset=utf8', 'sql480901', 'hW9*zG6*');
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		  $db->query("SET NAMES 'utf8'");

			$u = $db->prepare('UPDATE emails SET Email_adress = :mail, Name = :name WHERE ID=:id');
			$u->bindValue(':mail', $mail, PDO::PARAM_STR);
			$u->bindValue(':name', $name, PDO::PARAM_STR);
			$u->bindValue(':id', $idList[$randId], PDO::PARAM_INT);
			$u->execute();

			$executed = true;
		} catch(PDOException $error) {
			echo "PDO ERROR CODE: ".$error->getCode();
		}
	}
	exit();
}

?>

<html>
	<body>
		<a href="javascript:history.go(-1)">Retour à la galerie</a>
		<div id="centralBlock" style="width:400px; height:250px; border: 2px solid #000000; position: absolute; margin: auto; top: 0; right: 0; bottom: 0; left: 0;">
			<div id="title" style="text-align: center;">
				Inscription Naomaton
			</div>
			<div id="naoForm" style="text-align: center;">
			<?php 
				if(!$executed){
					echo"<form action=\"mail.php\" method=\"post\">
							<p>Votre Nom : <input type=\"text\" name=\"name\" /></p>
							<p>Votre Email : <input type=\"text\" name=\"email\" /></p>
							<p><input type=\"submit\" value=\"Envoyer\"></p>
						</form>";
				}
				else{
					echo "<br /> Bonjour ".htmlspecialchars($name).",<br />
						Votre email porte le numéro : ".$idList[$randId].".<br /><br />
						Toucher le ".$bumperCorrepondance[$randId]." d'HAL pour prendre votre photo.";
					echo "<img src=\"images/".$idList[$randId].".png\" alt='Bumper' />";
				}
				
			?>
			</div>
		<div>
	</body>
</html>
