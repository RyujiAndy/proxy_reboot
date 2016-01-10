<a>
<big>
<u>
**Script login proxy Reboot.Ms**
</u>
</big>
</a>

<a>
Script Utilizzato per la reggistrazione automatica degli utenti di reboot.ms sul database per il proxy (squid3) con autentificaziobne radius (freeradius)</a>

<a>
<big>
<u>
**Prerequisiti**
</u>
</big>
</a>

<a>
Preinstallazione di squid3 con autentificazione a freeradius-mysql
</a>

<a>
Database radius con seguente struttura:
</a>

<a>
CREATE DATABASE radius;
</a><br>
<a>
GRANT ALL PRIVILEGES ON radius.* TO radius@localhost IDENTIFIED BY "VOSTRA PASSWORD";
</a><br>
<a>
flush privileges;
</a><br>
<a>
exit
</a>

