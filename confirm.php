<?php

include_once("config/database.php");

if (isset($_GET['token']))
{
	$token = $_GET['token'];
	$db = db_open();
	try {
		foreach ($db->query("SELECT * FROM users") as $row) {
			if (hash("whirlpool", $row['username']) == $token) {
				$stm = $db->prepare("UPDATE users SET confirmed = 1 ".
					"WHERE username = ?");
				$stm->execute(array($row['username']));
			}
		}	
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}	
}

header();

?>

<script type="text/javascript">
	
window.location.href = "login.php";

</script>