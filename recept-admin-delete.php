<?php
	error_reporting(-1);
	include 'functions.php';

	$database = connectToDatabase();

	//deletion confirmed => delete
	if (isset($_POST['id'])) {
		$params = array();
		$params[] = $_POST['id'];
		$statement = $database->prepare("DELETE FROM Recept WHERE id=?");
		$statement->execute($params);

		//redirect to startpage
		header("Location: index.php?message=success");

	}
	else {
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
		else{
			$id=-1;
			$matnamn="";
			$recept="";
		}		
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
		<form action="recept-admin-delete.php" method="post"> 
			<input type="hidden" name="id" value="<?=$id?>" />
			<h2>
		  		<?=$matnamn?>
		  	</h2>
	  		<p>
		  		<?=$recept?>
		  	</p>

	  		<input type="submit" value="bekräfta ta bort"/> <a href="recept.php">ångra</a>
		</form>
	</body> 
</html>