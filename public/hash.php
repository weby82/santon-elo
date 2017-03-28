<?php

//hash.php?password=motdepasse
$password = $_REQUEST["password"];
echo password_hash($password, PASSWORD_BCRYPT);
//echo password_hash("toto", PASSWORD_BCRYPT);

?>