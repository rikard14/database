<?php
	/**
	 * Connect to the database.
	 * @return PDO database object
	 */
	function connectToDatabase() {
	    $dsn      = "mysql:host=localhost;dbname=Webbutveckling;";
	    $username    = "root";
	    $password = "";
	    $options  = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"];
	    $db = new PDO($dsn, $username, $password, $options);
	    return $db;	
	}
