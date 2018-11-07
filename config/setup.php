<?php

session_start();
session_destroy();

include_once("database.php");

try {
	$db = new PDO("mysql:host=localhost", $db_user, $db_pass, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$exists = (bool) $db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA ".
		"WHERE SCHEMA_NAME = \"$db_name\"");
	if (!$exists)
		die("Database \"$db_name\" already exists!");
	$db->query("CREATE DATABASE $db_name");
	$db->query("USE $db_name");
	$db->query("Create TABLE users (".
		"ID int NOT NULL AUTO_INCREMENT UNIQUE,".
		"username varchar(35) UNIQUE, email varchar(255) UNIQUE,".
		"pass varchar(1000), confirmed int, sendmail int, PRIMARY KEY(ID)".
	")");
	$db->query("Create TABLE posts (".
		"ID int NOT NULL AUTO_INCREMENT UNIQUE,".
		"user_id int, path varchar(255), date int".
	")");
	$db->query("Create TABLE reactions (".
		"ID int NOT NULL AUTO_INCREMENT UNIQUE,".
		"user_id int, post_id int,".
		"type int, data varchar(255),".
		"date int".
	")");
	$db->query("LOAD DATA LOCAL INFILE 'users.csv' INTO TABLE users ".
		"FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n' ".
		"IGNORE 1 LINES (ID, username, email, pass, confirmed, sendmail)"
	);
	$db->query("LOAD DATA LOCAL INFILE 'posts.csv' INTO TABLE posts ".
		"FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n' ".
		"IGNORE 1 LINES (ID, user_id, path, date) "
	);
	$db->query("LOAD DATA LOCAL INFILE 'reactions.csv' INTO TABLE reactions ".
		"FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n' ".
		"IGNORE 1 LINES (ID, user_id, post_id, type, data, date)"
	);
} catch (PDOException $e) {
	die("Error!: " . $e->getMessage() . PHP_EOL);
}

echo "Database \"$db_name\" succesfully created and populated!" . PHP_EOL;

?>
