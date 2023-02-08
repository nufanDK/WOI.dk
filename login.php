<?php
$mysql_server = "start.he.dk";
$mysql_user = "woi_dk";
$mysql_pass = "woi4ever";
$mysql_db = "woi_dk";

//LOGIN SCRIPT -- START

if (isset($login)) {

		$typedpass = $logintypedpass;
		$typednick = $logintypeduser;
		
		$mysql_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
		mysql_select_db($mysql_db, $mysql_connect);
		
		$logincmd = mysql_query("select PASSWORD('$typedpass') as loginpass");
		$loginarray = mysql_fetch_array($logincmd);
		$loginpass = $loginarray['loginpass'];
		
		$dbuserpass = mysql_query("select pass from users where nick = '$typednick'");
		$dbuserpassarray = mysql_fetch_array($dbuserpass);
		$userpass = $dbuserpassarray['pass'];
		
		if ($typedpass != NULL) {
			if ($loginpass == $userpass) {
			
				//ADMIN-SIDENS INDHOLD -- START

				echo "<span id=\"linkbanner\" class=\"linkbanner\">";
				echo "	<span id=\"forsidelink\" onclick=\"XMLrequest('functions.php?site=welcome&subsite=welcome', 'mainframe');\">Forside</span>";
				echo "	<span style=\"cursor:default;\"> > </span>";
				echo "	<span id=\"adminlink\"><u>Admin</u></span>";
				echo "</span><br><br>";
			
				echo "<span style=\"cursor:pointer;\" onclick=\"showwindow('functions.php?createnews=1', '212', '225', '1');\">Opret nyhed</span><br>";
				echo "<span style=\"cursor:pointer;\" onclick=\"showwindow('functions.php?editnews=1', '212', '59', '1');\">Rediger nyhed</span><br>";
				echo "<span style=\"cursor:pointer;\" onclick=\"showwindow('functions.php?deletenews=1', '212', '59', '1');\">Slet nyhed</span><br>";
				echo "<span style=\"cursor:pointer;\" onclick=\"showwindow('functions.php?drivingbook=1', '512', '59', '1');\">K&oslash;rebog</span><br>";
				echo "<span style=\"cursor:pointer;\" onclick=\"showwindow('functions.php?cal=1', '200', '200', '1');\">Kalender</span><br>";
								
				echo "<span id=\"adminwindow\" class=\"adminwindow\">Loading...</span></span><br>";
							
				//ADMIN-SIDENS INDHOLD -- SLUT
			
			} else {
				echo "Username/password is incorrect!";
			};
		} else {
			echo "Please type your username and password.";
		};

};
		
//LOGIN SCRIPT -- SLUT
?>