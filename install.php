<?php

include_once("camagru_db.php");

try {
	/* CREATE DATABASE */
	$db = new PDO("mysql:host=$db_host", $db_user, $db_pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$exists = (bool) $db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = $db_name");
	if ($exists)
		die("Database \"$db_name\" already exists!");
	$db->query("CREATE DATABASE $db_name");
	$db->query("USE $db_name");
	/* ADD TABLES */
	$db->query("Create TABLE users (".
		"ID int NOT NULL AUTO_INCREMENT UNIQUE,".
		"username varchar(35) UNIQUE, email varchar(255) UNIQUE,".
		"pass varchar(1000), PRIMARY KEY(ID)".
	")");
	$db->query("Create TABLE posts (".
		"ID int NOT NULL AUTO_INCREMENT UNIQUE,".
		"user_id int, path varchar(100), date int"
	")");
	$db->query("Create TABLE reactions (".
		"ID int NOT NULL AUTO_INCREMENT UNIQUE,".
		"user_id int, post_id int,".
		"type int, data varchar(255),"
		"date int"
	")");
	/* POPULATE TABLES */
	$db->query("LOAD DATA LOCAL INFILE 'users.csv' INTO TABLE users".
		"FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'".
		"IGNORE 1 LINES (ID, username, email, pass)"
	);
	$db->query("LOAD DATA LOCAL INFILE 'posts.csv' INTO TABLE posts".
		"FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'".
		"IGNORE 1 LINES (ID, user_id, path, date)"
	);
	$db->query("LOAD DATA LOCAL INFILE 'reactions.csv' INTO TABLE reactions".
		"FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'".
		"IGNORE 1 LINES (ID, user_id, post_id, type, data, date)"
	);
} catch (PDOException $e) {
	die("Error!: " . $e->getMessage() . "<br/>");
}

echo "Database \"$db_name\" succesfully created and populated!" . PHP_EOL;
