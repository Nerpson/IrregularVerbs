<?php
	//needs PDO object
	function DBCreation($db){
		$db->exec('CREATE TABLE IF NOT EXISTS verbs (id INTEGER PRIMARY KEY, french varchar(30), infinitive varchar(30), preterit varchar(30), pastPart varchar(30))');
		include 'db/dbInsert.php';
	}

	//The wierd string operations are all made in order to return a mysql valid list
	function randoms($howMany, $max){
		$ret = "(";
		$rands = [];
		for($i=0; $i<$howMany; $i++){
			do{
				$r = rand(0, $max);
			}while(in_array($r, $rands));

			$ret .= "'".$r."', ";
			array_push($rands, $r);
		}

		return substr($ret, 0, strlen($ret)-2).")";
	}

	$db = new PDO('sqlite:db/verbs.sqlite');
	$nb = $db->query('SELECT COUNT(*) FROM verbs')->fetch()[0];


	//DBCreation($db);
	$MAX_VERBS_A_TIME = 20;
	$nbVerbs = 5;



	/*********************************************
	
	Parameters treatment

	********************************************/

	//nbVerbs
	if(isset($_GET['nbVerbs'])){
		$nbVerbs = htmlspecialchars($_GET['nbVerbs']);
		if($nbVerbs > $MAX_VERBS_A_TIME)
			$nbVerbs = $MAX_VERBS_A_TIME;


		//To prevent my do...while loop to be infinite
		if($nbVerbs > $nb){
			echo 'Database length error<br />';
			exit();
		}

		//Getting randoms verbs
		$req = $db->query('SELECT * FROM verbs WHERE id IN '.randoms($nbVerbs, $nb));
		while($data = $req->fetch()){
			echo $data['french'], '<br>';
		}

		//outputing the html form
		$form = '<form method="post" action="?correction">';

			

		$form .= '<input type="submit" value="Submit !" /></form>';
	}
	

	// $rq = $db->query("SELECT * FROM verbs");
	// while($data = $rq->fetch())
	// 	echo $data['french'], '<br />';
?>



<!DOCTYPE html>
<html>
<head>
	<title>Irregular verbs test</title>
	<meta charset="utf-8" />
</head>
<body>
	<header><h1>Tests aléatoires de verbes irréguliers</h1></header>
	<aside>
		<form action="" method="GET">
			<label for="nbVerbs">How many verbs to display a time ?</label>
			<input type="number" id="nbVerbs" name="nbVerbs" value="<?php echo $nbVerbs; ?>"/>

			<input type="submit" value="Submit !" />

		</form>		
	</aside>
	<main>


	</main>
	<footer>Created by <a href="http://webmakers.fr">Webmakers.fr</a> and <a href="http://Jeneconnaispaslurl.com">Nerpson</a></footer>
</body>
</html>