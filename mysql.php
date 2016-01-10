<?php
$servername = "localhost";
$username = "radius";
$password = "";
$database ="radius";
$conn = new mysqli($servername, $username, $password, $database);

function connect ($typ) {
	global $conn;
	if ($typ) {
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			exit();
		}
	} else {
		$conn->close();
	}
}

function searchuser($username) {
	global $conn;
	$query = "SELECT `username`, `value` FROM `radcheck` WHERE `username` = '".$username."'";
	if (!$res = $conn->query($query)) {
		echo "Errore ricerca!";
		exit();
	}
	$row = $res->fetch_array(MYSQLI_ASSOC);
	if (!isset($row['username'])) return false;
	return true;
}

function newuser($username, $pass) {
	global $conn;
	$passmd5 = md5($pass);
	$query = "INSERT INTO `radcheck` (`username`, `attribute`, `op`, `value`) VALUE ('$username', 'MD5-Password', ':=', '$passmd5')";
	if (!$conn->query($query)) {
		echo "Errore Registrazione dati!";
		exit();
	}
	$query = "INSERT INTO `userinfo` (`username`) VALUE ('$username')";
	if (!$conn->query($query)) {
		echo "Errore Registrazione dati!";
		exit();
	}
}

function modifyuser($username, $pass) {
	global $conn;
	$passmd5 = md5($pass);
	$query = "UPDATE `radcheck` SET `value` = '".$passmd5."' WHERE `username` = '".$username."'";
	if (!$res = $conn->query($query)) {
		echo "Errore modifica dati!";
		exit();
	}
}

function listuser() {
	global $conn;
	
}

function deleteuser() {
	
}
?>
