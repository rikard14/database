<?php
	error_reporting(-1);
	include 'functions.php';

	$database = connectToDatabase();

	//select all from database
    $quary = "SELECT * FROM Recept;";
	$statement = $database->prepare($quary);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($result);

	//build html
	$outputHtml = "";
	foreach($result as $row) {
		$outputHtml .= "<h2>" . $row['matnamn'] . "</h2>";
		$outputHtml .= "<p>id " . $row['id'] . " <a href='recept-admin.php?id=" . $row['id'] . "'>ändra</a></p>";
		$outputHtml .= "<p>" . $row['recept'] . "</p>";
	}
	//disconnect from database
	$database = null;
?>

<!DOCTYPE html>
<html lang='sv'>
	<head> 
		<meta charset='utf-8' />   
		<title>Receptsamling</title> 
		<link rel='stylesheet' href='style.css'/> 
	</head> 
	<body><!--sidans innehåll--> 
		<h1>Hämtningar ur databas</h1>
		<p><a href="recept-admin.php?new=new">Lägg till recept.</a></p>
		<?=$outputHtml;?>
	</body> 
</html>