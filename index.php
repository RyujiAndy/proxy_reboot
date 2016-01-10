<?php
include"mysql.php";

$startTime = microtime(true);
$fileDir = '../forum';

require($fileDir . '/library/XenForo/Autoloader.php');
XenForo_Autoloader::getInstance()->setupAutoloader($fileDir . '/library');

XenForo_Application::initialize($fileDir . '/library', $fileDir);
XenForo_Application::set('page_start_time', $startTime);

XenForo_Session::startPublicSession();

$visitor = XenForo_Visitor::getInstance()->toArray();
$username = $visitor['username'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
       
<head>
               
        <title>Proxy Pass</title>
               


</head>
<body bgcolor="00979c">
<div align="center">
<img src="https://www.reboot.ms/forum/styles/arduinoux/arduinoux/logo.png"><br>Servizio Proxy per bloccare gli aggiornamenti Nintendo su Wii U e 3DS<br><br><br>
<?php
connect(true);
if ($visitor['user_id'] == 0){		
	echo "Prima di creare un account proxy devi registrarti al <a href=\"https://www.reboot.ms/forum/articles\">forum</a>!<br>";
	echo "<form action=\"https://www.reboot.ms/forum/login/login\" method=\"post\"><br>Nome utente:<input type=\"text\" name=\"login\" required><br>Password: <input type=\"password\" name=\"password\" required><br><button type=\"submit\" name=\"redirect\" value=\"/proxy\">Invia</button></form>";

} else {
	$user = searchuser($username);
	if (isset($_POST['action'])) {
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		$type = $_POST['action'];
		if ($pass1 == $pass2) {
			if ($user) {
				modifyuser($username, $pass1);
				echo "Nuova password registrata";
			} else {
				newuser($username, $pass1);
				echo "Nuovo utente registrato";
			}
		} else {
			$type = 2;
		}
	} 
	if (!isset($type) || $type == 2) {
		if ($user) {
			echo "Utente ".$username." esiste vuoi cambiare la password?";
		} else {
			echo "Utente ".$username." non esiste inserisci la nuova password";
		}
		echo "<form method=\"post\"><br>Nuova Password:<input type=\"password\" name=\"pass1\" minlength=\"6\" required><br>Ridigita password:<input type=\"password\" name=\"pass2\" minlength=\"6\" required><br><button type=\"submit\" name=\"action\" value=\"".$exist."\">Invia</button></form>";
		if ($type == 2) echo "<br><br><span style=\"color:#FF0000\">Le password non sono uguali</span>";
	}
}
connect(false);
?>
<br>Server Proxy: proxy.reboot.ms <-> Porta: 3128<br><br>Script creato da <a target="_blank" href="https://ryujiandy.i2cttl.com">RyujiAndy</a>
</div>
</body>
