<?php
	//needs PDO object
	function DBCreation($db){
		$db->exec('CREATE TABLE IF NOT EXISTS verbs (id INTEGER PRIMARY KEY, french varchar(30), infinitive varchar(30), preterit varchar(30), pastPart varchar(30))');
		include 'db/dbInsert.php';
	}

	$db = new PDO('sqlite:db/verbs.sqlite');
	//DBCreation($db);

	$rq = $db->query("SELECT * FROM verbs");
	while($data = $rq->fetch())
		echo $data['french'], '<br />';
?>



<!DOCTYPE html>
<html>
<head>
	<title>Irregular verbs test</title>
	<meta charset="utf-8" />
</head>
<body>
	<header><h1>Tests aléatoires de verbes irréguliers</h1></header>
	<main>
		<?php

		?>


	</main>
	<footer>Created by <a href="http://webmakers.fr">Webmakers.fr</a> and <a href="http://Jeneconnaispaslurl.com">Nerpson</a></footer>
</body>
</html>