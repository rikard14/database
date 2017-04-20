<?php
	error_reporting(-1);
	include 'functions.php';

	$database = connectToDatabase();

	/**
	 * Save changes, if made.
	 */
	function save($db) {
		if (isset($_POST)) {
			//(condition ? ture : false);
			(isset($_POST['id']) ? $id = $_POST['id'] : $id = "-1");
			(isset($_POST['matnamn']) ? $matnamn = $_POST['matnamn'] : $matnamn = "");
			(isset($_POST['recept']) ? $recept = $_POST['recept'] : $recept = "");

			$quary = "UPDATE Recept SET matnamn=?, recept=? WHERE id=?";
			//add elements to array, and clean code from tags
			$params = array();
			$params[] = strip_tags($matnamn);
			$params[] = strip_tags($recept);
			$params[] = $id;
			//update database
			$statement = $db->prepare($quary);
			$statement->execute($params);
		}
	}
	//save changes sent from form
	save($database);
	
	//add a new recipe
	//TODO might add an empty recipe
	if (isset($_GET['new']) && $_GET['new'] == 'new') {
		//add empty recipe
		$quary = "INSERT INTO Recept (matnamn, recept) VALUES ('', '');";

		$statement = $database->prepare($quary);
		$statement->execute();

		//fetch id of new recipe
		$statement = $database->prepare("SELECT MAX(id) AS id FROM Recept");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		//transfer id to form
		$_GET['id'] = $result[0]['id'];		
	}
	//display form
	//var_dump($_GET);
	if (isset($_GET['id'])) {
	    $quary = "SELECT * FROM Recept WHERE id=" . $_GET['id'] . ";";
	    $params = array();
		$statement = $database->prepare($quary);
		$statement->execute($params);
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($result);
		$id = $result[0]['id'];
		$matnamn = $result[0]['matnamn'];
		$recept = $result[0]['recept'];
	}
	else {
		//something is wrong
		exit("error")
	}
	//disconnect from database
	$database = null;
?>

<!DOCTYPE html>
<html lang='sv'>
	<head> 
		<meta charset='utf-8' />  
		<title>Ändra recept</title> 
		<link rel='stylesheet' href='style.css'/>
	</head> 
	<body><!--sidans innehåll--> 
		<p><a href="index.php">Återvänd till recepten.</a>
		<form action="recept-admin.php?id=<?=$id?>" method="post"> 
			<input type="hidden" name="id" value="<?=$id?>" />
			<p>
		  		<label for="matnamn">matnamn</label>
		  		<input type="text" id="matnamn" name="matnamn" value="<?=$matnamn?>"/>
		  	</p>
		  	<p>
		  		<label for="recept">Recept</label>
	  		</p>
	  		<p>
		  		<textarea id="recept" rows="10" cols="50" name="recept"><?=$recept?></textarea>
		  	</p>
	  		<input type="submit" value="spara"/> <a href="recept-admin-delete.php?id=<?=$id?>">ta bort</a>
		</form>
	</body> 
</html>