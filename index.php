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
	$MAX_VERBS_A_TIME = 100;
	$DEFAULT_NBVERBS = 5;
	$nbVerbs = $DEFAULT_NBVERBS;



	/*********************************************
	
	Parameters treatment

	********************************************/

	//nbVerbs
	if(isset($_GET['nbVerbs'])){
		$nbVerbs = htmlspecialchars($_GET['nbVerbs']);
		if($nbVerbs > $MAX_VERBS_A_TIME)
			$nbVerbs = $MAX_VERBS_A_TIME;
		elseif ($nbVerbs < 1)
			$nbVerbs = $DEFAULT_NBVERBS;


		//To prevent my do...while loop to be infinite
		if($nbVerbs > $nb){
			echo 'Database length error<br />';
			exit();
		}

		//Getting randoms verbs
		$req = $db->query('SELECT * FROM verbs WHERE id IN '.randoms($nbVerbs, $nb));

		//outputing the html form
		$content = '<form method="post" action="?correction"><table>
			<tr><th>French</th><th>Infinitive</th><th>Preterit</th><th>Past Participle</th>';

		$i = 0;
		while($data = $req->fetch()){
			$content .= '<tr><td><input type="hidden" id="'.$i.'-french" name="'.$i.'-french" value="'.$data['french'].'" />'.$data['french'].'</td>
			<td><input type="text" id="'.$i.'-infinitive" name="'.$i.'-infinitive" /></td>
			<td><input type="text" id="'.$i.'-preterit" name="'.$i.'-preterit" /></td>
			<td><input type="text" id="'.$i.'-pastPart" name="'.$i.'-pastPart" /></td></tr>';
			$i++;
		}

		$content .= '</table><input type="submit" value="Submit !" /></form>';

	}elseif (isset($_GET['correction'])) {
		
	}else{
		$content = '<form action="" method="GET">
			<label for="nbVerbs">How many verbs to display a time ?</label>
			<input type="number" id="nbVerbs" name="nbVerbs" value="'.$nbVerbs .'"/>

			<input type="submit" value="Submit !" />
		</form>';
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
	<header><h1><a href="/IrregularVerbs">Tests aléatoires de verbes irréguliers</a></h1></header>
	<main>
	<?php echo $content; ?>

	</main>
	<footer>Created by <a href="http://webmakers.fr">Webmakers.fr</a> and <a href="http://Jeneconnaispaslurl.com">Nerpson</a></footer>
</body>
</html>