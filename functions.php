<?php

$mysql_server = "start.he.dk";
$mysql_user = "woi_dk";
$mysql_pass = "woi4ever";
$mysql_db = "woi_dk";

//LINKSBANNER SCRIPT -- START
echo "<span id=\"linkbanner\" class=\"linkbanner\">";
if (isset($subsite)) {
	if ($site == 'welcome') {
		echo "<span id=\"forsidelink\" onclick=\"XMLrequest('functions.php?site=welcome&subsite=welcome', 'mainframe');\"><u>Forside</u></span>";
	} elseif ($site == 'profil' || $site == 'historie' || $site == 'vision') {
		echo "<span id=\"forsidelink\" onclick=\"XMLrequest('functions.php?site=welcome&subsite=welcome', 'mainframe');\">Forside</span>";
		echo "	<span style=\"cursor:default;\"> > </span>";
		echo "<span id=\"profillink\" onclick=\"XMLrequest('functions.php?site=profil&subsite=profil', 'mainframe');\">";
				if ($subsite == 'profil') { echo "<u>Profil</u>"; } else { echo "Profil"; };
		echo "</span>";
		echo "	<span style=\"cursor:default;\"> > </span>";
		echo "<span id=\"visionlink\" onclick=\"XMLrequest('functions.php?site=vision&subsite=vision', 'mainframe');\">";
				if ($subsite == 'vision') { echo "<u>Vision</u>"; } else { echo "Vision"; };
		echo "</span>";
		echo "	<span style=\"cursor:default;\"> > </span>";
		echo "<span id=\"historielink\" onclick=\"XMLrequest('functions.php?site=historie&subsite=historie', 'mainframe');\">";
				if ($subsite == 'historie') { echo "<u>Historie</u>"; } else { echo "Historie"; };
		echo "</span>";
	} elseif ($site == 'produkter' || $products == 'notebook' || $site == 'webdesign') {
		echo "<span id=\"forsidelink\" onclick=\"XMLrequest('functions.php?site=welcome&subsite=welcome', 'mainframe');\">Forside</span>";
		echo "	<span style=\"cursor:default;\"> > </span>";
		echo "<span id=\"oversigtlink\" onclick=\"XMLrequest('functions.php?site=produkter&subsite=produkter', 'mainframe');\">";
				if ($subsite == 'produkter') { echo "<u>Produkter</u>"; } else { echo "Produkter"; };
		echo "</span>";
		echo "	<span style=\"cursor:default;\"> > </span>";
		echo "<span id=\"notebookslink\" onclick=\"XMLrequest('functions.php?products=notebook&subsite=notebooks', 'mainframe');\">";
				if ($subsite == 'notebooks') { echo "<u>Notebooks</u>"; } else { echo "Notebooks"; };
		echo "</span>";	
		echo "	<span style=\"cursor:default;\"> > </span>";
		echo "<span id=\"webdesignlink\" onclick=\"XMLrequest('functions.php?site=webdesign&subsite=webdesign', 'mainframe');\">";
				if ($subsite == 'webdesign') { echo "<u>Webdesign</u>"; } else { echo "Webdesign"; };
		echo "</span>";			
	} elseif ($site == 'templates') {
		echo "<span id=\"forsidelink\" onclick=\"XMLrequest('functions.php?site=welcome&subsite=welcome', 'mainframe');\">Forside</span>";
		echo "	<span style=\"cursor:default;\"> > </span>";
		echo "<span id=\"templateslink\" onclick=\"XMLrequest('functions.php?site=templates&subsite=templates', 'mainframe');\">";
				if ($subsite == 'templates') { echo "<u>Templates</u>"; } else { echo "Templates"; };
		echo "</span>";
	} elseif ($site == 'links') {
		echo "<span id=\"forsidelink\" onclick=\"XMLrequest('functions.php?site=welcome&subsite=welcome', 'mainframe');\">Forside</span>";
		echo "	<span style=\"cursor:default;\"> > </span>";
		echo "<span id=\"templateslink\" onclick=\"XMLrequest('functions.php?site=links&subsite=links', 'mainframe');\">";
				if ($subsite == 'links') { echo "<u>Links</u>"; } else { echo "Links"; };
		echo "</span>";
	} elseif ($site == 'kontakt') {
		echo "<span id=\"forsidelink\" onclick=\"XMLrequest('functions.php?site=welcome&subsite=welcome', 'mainframe');\">Forside</span>";
		echo "	<span style=\"cursor:default;\"> > </span>";
		echo "<span id=\"templateslink\" onclick=\"XMLrequest('functions.php?site=kontakt&subsite=kontakt', 'mainframe');\">";
				if ($subsite == 'kontakt') { echo "<u>Kontakt</u>"; } else { echo "Kontakt"; };
		echo "</span>";
	};
};
echo "</span><br><br>";
//LINKBANNER SCRIPT -- SLUT


//MAINFRAME SCRIPT -- START
if (isset($site)) {

	$sitephp = "$site.php";
	include($sitephp);

}
//MAINFRAME SCRIPT -- SLUT


//BANNERCHANGE SCRIPT -- START
if (isset($banner)) {
		echo "<html>		\n";
		echo "<head>		\n";
		echo "		\n";
		echo "</head>		\n";
		echo "		\n";
		echo "<body bgcolor=\"#FFFFFF\" style=\"margin:0px;\" onload=\"document.getElementById('bannerpic').filters.blendTrans.Apply(); document.getElementById('bannerpic').filters.blendTrans.Play();\">		\n";
		echo "		\n";
		echo "<img id=\"bannerpic\" height=\"$bannerheight\" width=\"$bannerwidth\" border=\"0\" style=\"position:absolute; top:0px; left:0px; filter:blendTrans(duration=1);\" src=\"pics/banner/$banner.jpg\" onload=\"document.getElementById('bannerpic').filters.blendTrans.Apply(); document.getElementById('bannerpic').filters.blendTrans.Play();\">";
		echo "		\n";
		echo "</body>		\n";
		echo "</html>		\n";
};
//BANNERCHANGE SCRIPT -- SLUT


//PRODUCT OVERVIEW SCRIPT -- START
if (isset($products)) {
		$mysql_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
		mysql_select_db($mysql_db, $mysql_connect);
		
		$notebooks_query1 = mysql_query("select * from products where type='$products' order by id asc", $mysql_connect);
		
		$counter = 1;
		
		echo "<div id=\"templatesbox\" class=\"notebookbox\">";
		echo "Loading...";
		echo "</div>";
		
		while ($notebooks_query = mysql_fetch_array($notebooks_query1)) {
		
		$id = $notebooks_query['id'];
		$name = $notebooks_query['name'];
		$escaped_name = "REMOVE THIS ALONG WITH NOTEBOOKHEADER";
		$shortstory = $notebooks_query['shortstory'];
		$price = $notebooks_query['price'];
		
		echo "	<!-- Notebook $id -- START !-->		\n";
		echo "	<span class=\"templatestable\">		\n";
		echo "		<div class=\"templatesheader$counter\">		\n";
		echo "			<div style=\"padding-left:3px;\">	\n";
		echo "				$name	\n";
		echo "			</div>		\n";
		echo "		</div>		\n";
		echo "		<div class=\"templatesimagediv\">		\n";
		echo "			<img id=\"templatesimage$counter\" class=\"templatesimage\" src=\"pics/notebooks/small/notebook$id/notebook" . $id . "_0.jpg\" onclick=\"zoomnotebooks('$id', '$name');\">		\n";
		echo "		</div>		\n";
		echo "		<div class=\"templatesindex\">		\n";
		echo "			<div style=\"padding:3px;\">		\n";
		echo "				$shortstory		\n";
		echo "			</div>		\n";
		echo "		</div>		\n";
		echo "		<div class=\"templateslink\">		\n";
		echo "			<span onclick=\"XMLrequest('functions.php?notebooks=info&notebookheader=$escaped_name&notebooknr=$id','templatesbox'); showtemplatesinfobox(this);\">		\n";
		echo "				&nbsp;info		\n";
		echo "			</span>		\n";
		echo "				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		\n";
		echo "				<span style=\"color:#999999; font-size:12px;\"><b>DKR $price</b></span>		\n";
		echo "				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		\n";
					
		echo "			<span onclick=\"zoomnotebooks('$id', '$name');\">		\n";
		echo "				zoom		\n";
		echo "			</span>		\n";
		echo "		</div>		\n";
		echo "		<div style=\"height:50px;\">		\n";
		echo "			&nbsp;		\n";
		echo "		</div>		\n";
		echo "	</span>		\n";
		echo "	<!-- Notebook $id -- SLUT !-->		\n";
		
		if ($counter == 1) {
			$counter = 2;
		} else {
			$counter = 1;
		};

	};
mysql_close($mysql_connect);
};
//PRODUCT OVERVIEW SCRIPT -- SLUT


//NOTEBOOK-INFO SCRIPT -- START
if (isset($notebooks)) {
		if ($notebooks == 'info') {

			$mysql_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
			mysql_select_db($mysql_db, $mysql_connect);
			
			$info_query = mysql_query("select * from products where id=$notebooknr", $mysql_connect);

			while ($info_array = mysql_fetch_array($info_query)) {

				$cpu = $info_array['cpu'];
				$ram = $info_array['ram'];
				$hd = $info_array['hd'];
				$screen = $info_array['screen'];
				$gfx = $info_array['gfx'];
				$ethernet = $info_array['ethernet'];
				$wireless = $info_array['wireless'];
				$weight = $info_array['weight'];
					$pre_various = $info_array['various'];
				$various = nl2br($pre_various);
			
			};
											
			echo "<span style=\"letter-spacing:1; color:#6daa5a;\"><b>$notebookheader:</b></span>";
			echo "<span class=\"closebutton\" onclick=\"showtemplatesinfobox('', 1);\">X</span>";
			echo "<br><br>";
			
			echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" style=\"padding-right:6px; font: normal normal 9px verdana, tahoma;\">		\n";
			echo "	<tr>		\n";
			echo "		<td align=\"left\">CPU:</td>	\n";
			echo "		<td align=\"right\">$cpu MHz</td>	\n";
			echo "	</tr>		\n";
			echo "	<tr><td style=\"font-size:10px;\">&nbsp;</td></tr>		\n";
			echo "	<tr>	\n";
			echo "		<td align=\"left\">RAM:</td>		\n";
			echo "		<td align=\"right\">$ram MB DDRII</td>		\n";
			echo "	</tr>		\n";
			echo "	<tr><td style=\"font-size:10px;\">&nbsp;</td></tr>		\n";
			echo "	<tr>		\n";
			echo "		<td align=\"left\">Harddisk:</td>		\n";
			echo "		<td align=\"right\">$hd GB</td>		\n";
			echo "	</tr>		\n";
			echo "	<tr><td style=\"font-size:10px;\">&nbsp;</td></tr>		\n";
			echo "	<tr>	\n";
			echo "		<td align=\"left\">Sk&aelig;rm:</td>	\n";
			echo "		<td align=\"right\">$screen TFT</td>		\n";
			echo "	</tr>		\n";
			echo "	<tr><td style=\"font-size:10px;\">&nbsp;</td></tr>		\n";
			echo "	<tr>		\n";
			echo "		<td align=\"left\">Grafikkort:</td>		\n";
			echo "		<td align=\"right\">$gfx</td>		\n";
			echo "	</tr>		\n";
			echo "	<tr><td style=\"font-size:10px;\">&nbsp;</td></tr>		\n";
			echo "	<tr>		\n";
			echo "		<td align=\"left\">Netkort:</td>		\n";
			echo "		<td align=\"right\">$ethernet Mbit</td>		\n";
			echo "	</tr>		\n";
			echo "	<tr><td style=\"font-size:10px;\">&nbsp;</td></tr>		\n";
			echo "	<tr>		\n";
			echo "		<td align=\"left\">Wireless:</td>		\n";
			echo "		<td align=\"right\">$wireless</td>		\n";
			echo "	</tr>		\n";
			echo "	<tr><td style=\"font-size:10px;\">&nbsp;</td></tr>		\n";
			echo "	<tr>		\n";
			echo "		<td align=\"left\">V&aelig;gt:</td>		\n";
			echo "		<td align=\"right\">$weight gram</td>		\n";
			echo "	</tr>		\n";
			echo "	<tr><td style=\"font-size:10px;\">&nbsp;</td></tr>		\n";
			echo "	<tr>	\n";
			echo "		<td align=\"left\" valign=\"top\">Diverse:&nbsp;</td>		\n";
			echo "		<td align=\"right\">		\n"; 
			echo "			$various  \n";
			echo "		</td>		\n";
			echo "	</tr>		\n";	
			echo "</table>		\n";
		
		mysql_close($mysql_connect);
						
		} elseif ($notebooks == 'zoom') {
		
		$maindir = getcwd();
		$picsdir = "pics/notebooks";
		$wdir = $maindir . "/" . $picsdir . "/small/notebook" . $notebooknr;
		
		$templatesubnr = 0;
		
		echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
		echo "<html>	\n";
		echo "<head>	\n";
		echo "	<title>$notebookheader</title>	\n\n";
		echo "		";
		echo "<script type=\"text/javascript\" language=\"JavaScript\">	\n";
		echo "<!--	\n";
		echo "var submenushown = 0; 	\n";
		echo "var oldmenu;		\n";
		echo "		\n";
		echo "function changebackpic(nr)	\n";
		echo "{		\n";
		echo "		document.body.background = \"pics/notebooks/large/notebook" . $templatenr . "_\" + nr + \".jpg)\";	\n";
		echo "};	\n";
		echo "		\n";
		echo "function showsubmenu(menu)	\n";
		echo "{		\n";
		echo "	if (submenushown == 0) {	\n";
		echo "		document.getElementById(menu).style.visibility = 'visible';		\n";
		echo "		document.getElementById('menu2').style.zIndex = '1';		\n";
		echo "		\n";
		echo "		oldmenu = menu;		\n";
		echo "		submenushown = 1;		\n";
		echo "	} else if (submenushown == 1) {		\n";
		echo "		if (oldmenu == menu) {		\n";
		echo "			document.getElementById(menu).style.visibility = 'hidden';		\n";
		echo "			document.getElementById('menu2').style.zIndex = '-1';		\n";
		echo "		\n";
		echo "			submenushown = 0;";
		echo "		} else {		\n";
		echo "			document.getElementById(oldmenu).style.visibility = 'hidden';		\n";
		echo "			document.getElementById(menu).style.visibility = 'visible';		\n";
		echo "			document.getElementById('menu2').style.zIndex = '1';		\n";
		echo "			\n";
		echo "			oldmenu = menu;		\n";
		echo "		};";
		echo "	};		\n";
		echo "};	\n";
		echo "		\n";
		echo "-->	\n";
		echo "</script>	\n";
		echo "		\n";
		echo "<meta name=\"generator\" content=\"TSW WebCoder\">	\n";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/style.css\">	\n";
		echo "</head>	\n";
		echo "<style type=\"text/css\">		\n";
		echo "	body {margin:0; padding:0px; border:0; height:100%; overflow-y:auto; background-repeat: no-repeat; background-attachment:fixed;}	\n";
		echo "	body {font-family: verdana, tahoma; font-size:12px;}	\n";
		echo "		\n";
		echo "	#menu {top:0px; left:0px; position:fixed; border:1px #000000 solid; padding:0px; margin:0px; color:#000000;}		\n";
		echo "	* html #menu {position:absolute;}		\n";
		echo "		\n";
		echo "	#menu2 {top:20px; left:0px; width:776px; position:fixed; padding:0px; color:#000000; z-index:-1;}		\n";
		echo "	* html #menu2 {position:absolute;}		\n";
		echo "		\n";
		echo "	#picmenu {margin-left:660px; margin-top:30px; margin-right:0px; display:block;}		\n";
		echo "	#picmenu .right {float:right;}		\n";
		echo "</style>	\n";
		echo "		\n";
		echo "<!--[if lte IE 6]>		\n";
		echo "  <style type=\"text/css\">		\n";
		echo "   /*<![CDATA[*/ 		\n";
		echo "		html {overflow-x:auto; overflow-y:hidden;}		\n";
		echo "   /*]]>*/		\n";
		echo "	</style>		\n";
		echo "<![endif]-->		\n";
		echo "		\n";
		echo "<body background=\"pics/notebooks/large/notebook" . $notebooknr . "/notebook" . $notebooknr . "_0.jpg\">";

		echo "<table id=\"menu\" cellpadding=\"0\" cellspacing=\"0\">";
		echo "	<tr style=\"cursor:pointer;\">";
		echo "		<td>";
		echo "			<img src=\"pics/site/notebookzoom_blueleftside.jpg\" border=\"0\" height=\"18\" width=\"8\" style=\"display:block;\">";		
		echo "		</td>";
		echo "		<td onclick=\"showsubmenu('specsTD');\" class=\"notebookmenu\" style=\"background-image:url('pics/site/notebookzoom_blueback.jpg');\">";
		echo "			&nbsp;&nbsp;&nbsp;	Specifikationer";
		echo "		</td>";
		echo "		<td>";
		echo "			<img src=\"pics/site/notebookzoom_bluerightside.jpg\" border=\"0\" height=\"18\" width=\"8\" style=\"display:block;\">";
		echo "		</td>";
		echo "		<td>";
		echo "			<img src=\"pics/site/notebookzoom_greenleftside.jpg\" border=\"0\" height=\"18\" width=\"8\" style=\"display:block;\">";		
		echo "		</td>";
		echo "		<td onclick=\"showsubmenu('accessoriesTD');\" class=\"notebookmenu\" style=\"border-right:0px; background-image:url('pics/site/notebookzoom_greenback.jpg');\">";
		echo "			&nbsp;&nbsp;&nbsp;	Tilbeh&oslash;r";
		echo "		</td>";
		echo "		<td>";
		echo "			<img src=\"pics/site/notebookzoom_greenrightside.jpg\" border=\"0\" height=\"18\" width=\"8\" style=\"display:block;\">";
		echo "		</td>";
		echo "	</tr>";
		echo "</table>";
		
		echo "<table id=\"menu2\" cellpadding=\"0\" cellspacing=\"0\">";
		echo "	<tr id=\"menubar\">";
		echo "		<td id=\"specsTD\" style=\"visibility:hidden; border-bottom:1px #000000 solid; border-top:0px; color:#000000; background-color:#d9d9d9;\">";
		echo "			<iframe frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\" width=\"100%\" style=\"background-color:#d9d9d9; height:350px;\" src=\"notebookinfo/notebook" . $notebooknr . "_udvidet.php\"></iframe>";
		echo "		</td>";
		echo "		<td id=\"accessoriesTD\" style=\"visibility:hidden; border-left:1px #000000 solid; border-bottom:1px #000000 solid; border-top:0px; background-color:#d9d9d9;\">";
		echo "			<iframe frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\" width=\"100%\" style=\"background-color:#d9d9d9; height:350px;\" src=\"notebookinfo/notebook" . $notebooknr . "_tilbehor.php\"></iframe>";
		echo "		</td>";
		echo "	</tr>";
		echo "</table>";

		echo "		<div id=\"picmenu\">";
		
		if (is_dir($wdir)) {
			$openeddir = opendir($wdir);
			
			$notebooksubnr = 0;
			
			while (($file = readdir($openeddir)) !== false) {
				if (!is_dir($wdir . '/'. $file)) {
					echo "			<img id=\"menuimage\" style=\"display:block; filter:alpha(opacity=65); -moz-opacity:0.65; border:1px solid #000000; cursor: pointer;\"onclick=\"document.body.background = 'pics/notebooks/large/notebook" . $notebooknr . "/notebook" . $notebooknr ."_" . $notebooksubnr . ".jpg';\" src=\"pics/notebooks/small/notebook" . $notebooknr . "/notebook" . $notebooknr ."_" . $notebooksubnr . ".jpg\" width=\"100\" height=\"75\">";
					echo "			<br>";
				$notebooksubnr++;
				};
			};
		};
		closedir($openeddir);
		
		echo "		</div>";
		echo "		";
		echo "</body>";
		echo "</html>";
	};
};
//NOTEBOOK-INFO SCRIPT -- SLUT


//NEWS SCRIPT -- START
if (isset($news)) {
	
	$ratedwords = array("æ", "ø", "å");
	$unratedwords = array("&aelig;", "&oslash;", "&aring;");
	
	if ($news == 1) {
	
		//LISTE OVER ALLE NYHEDERNE
		$mysql_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
		mysql_select_db($mysql_db, $mysql_connect);
		
		$news_query = mysql_query("select date, header, id from news order by id desc", $mysql_connect);
		$varnumber = 0;
	
			while ($newsrow = mysql_fetch_array($news_query)) {
				if ($number <= 6) {
					$newsid = $newsrow['id'];
					echo "<div style=\"cursor:pointer;\" onclick=\"XMLrequest('functions.php?news=2&id=$newsid', 'mainframe')\">&nbsp;";
					echo $newsrow['date'];
					echo '&nbsp;::&nbsp;';
					$newsheader = str_replace($ratedwords, $unratedwords, $newsrow['header']);
					echo $newsheader;
					echo '</div>';
					$number ++;
				};
			};
		
		mysql_close($mysql_connect);
		
	} elseif ($news == 2) {
		//HENT DEN VALGTE NYHED
		$mysql_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
		mysql_select_db($mysql_db, $mysql_connect);
		
			$newsindex = mysql_query("select * from news where id=$id", $mysql_connect);
			$newsindexrow = mysql_fetch_array($newsindex);
			$newsheadertitle = $newsindexrow['header'];
	
			$newspic = $newsindexrow['picture'];
		
		echo "<span id=\"linkbanner\" class=\"linkbanner\">";	
		echo "<span id=\"forsidelink\" onclick=\"XMLrequest('functions.php?site=welcome&subsite=welcome', 'mainframe');\">Forside</span>";
		echo "	<span style=\"cursor:default;\"> > </span>";
		echo "<span id=\"newslink\" style=\"cursor:default;\"><u>Nyheder</u></span>";
		echo "</span><br><br>";
						
				echo "<div class=\"newsheader\">";
					 $newsindexheader = str_replace($ratedwords, $unratedwords, $newsindexrow['header']);
				echo $newsindexheader;
				echo "</div>";
				
				echo "<div class=\"author\">";
				echo "	Skrevet af: ";
				echo $newsindexrow['author'];
				echo "</div>";
				echo "<br><div style=\"line-height: 160%;\">";
						$newsindextextnobrakes = $newsindexrow['index'];
						$newsindextextunrated = nl2br("$newsindextextnobrakes");
						
						$newsindextext = str_replace($ratedwords, $unratedwords, $newsindextextunrated);
				
						echo $newsindextext;
				echo "</div>";
				
		mysql_close($mysql_connect);
		
	};
};
//NEWS SCRIPT -- SLUT

//CREATENEWS FORM SCRIPT -- START
if (isset($createnews)) {
	if ($createnews == 1) {
	$newsday = date(d);
	$newsmonth = date(m);
	$newsyear = date(y);
	
	echo "<form style=\"margin:0px; padding:0px;\">";
	echo "		<label for=\"newsdate\" class=\"adminwindow\">Dato:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "		<label for=\"newsheader\" class=\"adminwindow\">Overskrift:</label>";
	echo "		<span id=\"closebutton\" class=\"closebutton\" onclick=\"showwindow();\">X</span><br>";
	echo "	<input id=\"newsdate\" style=\"width:55px;\" class=\"newsbox\" maxlength=\"8\" name=\"newsdate\" type=\"text\" value=\"$newsday-$newsmonth-$newsyear\">";
	echo "	<input id=\"newsheader\" style=\"width:141px;\" class=\"newsbox\" name=\"newsheader\" type=\"text\" maxlength=\"15\"><br>";
	echo "		<label for=\"newsindex\" class=\"adminwindow\">Indhold:</label><br>";
	echo "	<textarea id=\"newsindex\" name=\"newsindex\" class=\"newsindex\"></textarea><br>";
	echo "		<label for=\"newsauthor\" class=\"adminwindow\">Forfatter:</label><br>";
	echo "	<input id=\"newsauthor\" style=\"width:125px;\" class=\"newsbox\" name=\"newsauthor\" type=\"text\" maxlength=\"20\">";
	echo "	<input type=\"button\" class=\"button\" value=\"Opret\" onclick=\"createnews();\">";
	echo "</form>";

	} elseif ($createnews == 2) {
	$createnews_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
	mysql_select_db($mysql_db, $createnews_connect);
	
	mysql_query("insert into `news` (`date`, `header`, `index`, `author`) values ('$newsdate', '$newsheader', '$newsindex', '$newsauthor')");
	mysql_close($createnews_connect);
	echo "Nyheden blev oprettet..";
	};
};
//CREATENEWS FORM SCRIPT -- SLUT

//EDITNEWS FORM SCRIPT -- START
if (isset($editnews)) {
	
	$ratedwords = array("æ", "ø", "å");
	$unratedwords = array("&aelig;", "&oslash;", "&aring;");
		
	$editnews_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
	mysql_select_db($mysql_db, $editnews_connect);
		
	if ($editnews == 1 || $editnews == 2) {
		

		echo "<form align=\"right\" name=\"editnewslist\" style=\"margin:0px; padding:0px;\">";
		echo "	<label for=\"newsheader\" class=\"adminwindow\">V&aelig;lg nyhed:</label>";
		echo "	<span id=\"closebutton\" class=\"closebutton\" onclick=\"showwindow();\">X</span><br>";
		echo "		<div style=\"font-size:2px;\">&nbsp;</div>";
		echo "	<select style=\"width:200px; font: normal normal 9px verdana, tahoma;\" name=\"newsheader\" id=\"newsheader\">";

		$editnews_selection = mysql_query("select header, date, id from news order by id desc", $editnews_connect);
		
		while ($editnews_row = mysql_fetch_array($editnews_selection)) {
				$editnewsheadertext = $editnews_row['header'];
				$editnews_option = str_replace($ratedwords, $unratedwords, $editnewsheadertext);
				$editnewsdate = $editnewsheadertext = $editnews_row['date'];
				$editnewsID = $editnewsheadertext = $editnews_row['id'];			
			echo "<option value=\"$editnewsID\">".  $editnewsdate . "&nbsp;::&nbsp;"  . $editnews_option . "</option>";
		};

		echo "	</select>";
		echo "<div style=\"font-size:3px;\">&nbsp;</div>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type=\"button\" class=\"button\" value=\"Rediger\" onclick=\"editnewswindow('functions.php?editnews=2', '212', '300', '1');\">";
		echo "</form>";
	
		if ($editnews == 2) {
		
			$chosennews_selection = mysql_query("select * from news where id=$chosennewsID", $editnews_connect);
			$chosennews_row = mysql_fetch_array($chosennews_selection);
			
			$chosennews_header_unrated = $chosennews_row['header'];
			$chosennews_index_unrated = $chosennews_row['index'];
			$chosennews_author_unrated = $chosennews_row['author'];
			
			$chosennews_date = $chosennews_row['date'];
			$chosennews_header = str_replace($ratedwords, $unratedwords, $chosennews_header_unrated);
			$chosennews_index = str_replace($ratedwords, $unratedwords, $chosennews_index_unrated);
			$chosennews_author = str_replace($ratedwords, $unratedwords, $chosennews_author_unrated);
				
			echo "<br><hr>";
			echo "		<div style=\"font-size:2px;\">&nbsp;</div>";			
			echo "<form style=\"margin:0px; padding:0px;\">";
			echo "		<label for=\"editnewsdate\" class=\"adminwindow\">Dato:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "		<label for=\"editnewsheader\" class=\"adminwindow\">Overskrift:</label><br>";
			echo "	<input id=\"editnewsdate\" style=\"width:55px;\" class=\"newsbox\" maxlength=\"8\" name=\"newsdate\" type=\"text\" value=\"$chosennews_date\">";
			echo "	<input id=\"editnewsheader\" style=\"width:141px;\" class=\"newsbox\" name=\"newsheader\" type=\"text\" maxlength=\"15\" value=\"$chosennews_header\"><br>";
			echo "		<label for=\"editnewsindex\" class=\"adminwindow\">Indhold:</label><br>";
			echo "	<textarea id=\"editnewsindex\" name=\"newsindex\" class=\"newsindex\">$chosennews_index</textarea><br>";
			echo "		<label for=\"editnewsauthor\" class=\"adminwindow\">Forfatter:</label><br>";
			echo "	<input id=\"editnewsauthor\" style=\"width:125px;\" class=\"newsbox\" name=\"newsauthor\" type=\"text\" maxlength=\"20\" value=\"$chosennews_author\">";
			echo "	<input type=\"button\" class=\"button\" value=\"Opdater\" onclick=\"updatenews('$chosennewsID');\">";
			echo "</form>";
		
		};
			
	} elseif ($editnews == 3) {
	
		if (mysql_query("UPDATE `news` SET `date`='$editnewsdate', `header`='$editnewsheader', `index`='$editnewsindex', `author`='$editnewsauthor' WHERE `id`='$variableID'")) {
			echo "Nyheden blev opdateret..";
		} else {
			echo "Foresp&oslash;rgslen kunne ikke gennemf&oslash;res!";
		};

	};
	
	mysql_close($editnews_connect);

};
//EDITNEWS FORM SCRIPT -- SLUT


//DELETENEWS FORM SCRIPT -- START
if (isset($deletenews)) {
	
	$ratedwords = array("æ", "ø", "å");
	$unratedwords = array("&aelig;", "&oslash;", "&aring;");
		
	$deletenews_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
	mysql_select_db($mysql_db, $deletenews_connect);
	
	if($deletenews == 1) {
	
		echo "<form name=\"deletenewslist\" style=\"margin:0px; padding:0px;\">";
		echo "	<label for=\"newsheader\" class=\"adminwindow\">V&aelig;lg nyhed:</label>";
		echo "	<span id=\"closebutton\" class=\"closebutton\" onclick=\"showwindow();\">X</span><br>";
		echo "		<div style=\"font-size:2px;\">&nbsp;</div>";
		echo "	<select style=\"width:200px; font: normal normal 9px verdana, tahoma;\" name=\"newsheader\" id=\"newsheader\">";

		$deletenews_selection = mysql_query("select header, date, id from news order by id desc", $deletenews_connect);
		
		while ($deletenews_row = mysql_fetch_array($deletenews_selection)) {
				$deletenewsheadertext = $deletenews_row['header'];
				$deletenews_option = str_replace($ratedwords, $unratedwords, $deletenewsheadertext);
				$deletenewsdate = $deletenewsheadertext = $deletenews_row['date'];
				$deletenewsID = $deletenewsheadertext = $deletenews_row['id'];			
			echo "<option value=\"$deletenewsID\">".  $deletenewsdate . "&nbsp;::&nbsp;"  . $deletenews_option . "</option>";
		};

		echo "	</select>";
		echo "<div style=\"font-size:3px;\">&nbsp;</div>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type=\"button\" class=\"button\" value=\"Slet\" onclick=\"deletenews();\">";
		
		echo "</form>";
		
	} elseif ($deletenews == 2) {
		if (mysql_query("delete from `news` where id='$chosennewsID'")) {
			echo "Nyheden blev slettet..";
		} else {
			echo "Foresp&oslash;rgslen kunne ikke gennemf&oslash;res!";
		};
	};

};
//DELETENEWS FORM SCRIPT -- SLUT


//TEMPLATES-INFO SCRIPT -- START
	if (isset($templates)) {
		if ($templates == 'info') {
		
			echo "<span style=\"letter-spacing:1; color:#6daa5a;\"><b>$templateheader:</b></span>";
			echo "<span class=\"closebutton\" onclick=\"showtemplatesinfobox('', 1);\">X</span>";
			echo "<br><br>";
			
			include('templateinfo/template' . $templatenr . '.php');
			
		} elseif ($templates == 'zoom') {
		
			$maindir = getcwd();
			$picsdir = "pics/templates";
			$wdir = $maindir . "/" . $picsdir . "/small/template" . $templatenr;
			
			$templatesubnr = 0;
			
			echo "<html>";
			echo "<head>";
			echo "	<title>$templateheader</title>";
			echo "		";
			echo "<script type=\"text/javascript\" language=\"JavaScript\">";
			echo "<!--";
			echo "		";
			echo "function changebackpic(nr)";
			echo "{		";
			echo "		document.body.background = \"pics/templates/large/template" . $templatenr . "_\" + nr + \".jpg)\";";
			echo "}		";
			echo "-->";
			echo "</script>";
			echo "<meta name=\"generator\" content=\"TSW WebCoder\">";
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/style.css\">";
			echo "</head>";
			echo "<style type=\"text/css\">";
			echo "		#menu {position:absolute; top:20px; right:20px;};";
			echo "		* html #menuimage {display:block; filter:alpha(opacity=65);};";
			echo "</style>";
			echo "		";
			echo "<body background=\"pics/templates/large/template" . $templatenr . "/template" . $templatenr . "_0.jpg\" style=\"margin:0px; background-repeat: no-repeat; background-attachment:fixed;\">";
			echo "		";
			echo "		<div id=\"menu\">";
			
			if (is_dir($wdir)) {
				$openeddir = opendir($wdir);
				
				$templatesubnr = 0;
				
				while (($file = readdir($openeddir)) !== false) {
					if (!is_dir($wdir . '/'. $file)) {
						echo "			<img id=\"menuimage\" style=\"display:block; -moz-opacity:0.65; border:1px solid #000000; cursor: pointer;\"onclick=\"document.body.background = 'pics/templates/large/template" . $templatenr . "/template" . $templatenr ."_" . $templatesubnr . ".jpg';\" src=\"pics/templates/small/template" . $templatenr . "/template" . $templatenr ."_" . $templatesubnr . ".jpg\" width=\"100\" height=\"75\">";
						echo "			<br>";
					$templatesubnr++;
					};
				};
			};
			closedir($openeddir);
			
			echo "		</div>";
			echo "		";
			echo "</body>";
			echo "</html>";
		};
	};
//TEMPLATES-INFO SCRIPT -- SLUT


//KØREBOG -- START
if (isset($drivingbook)) {
	
	$ratedwords = array("æ", "ø", "å");
	$unratedwords = array("&aelig;", "&oslash;", "&aring;");
		
	$deletenews_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
	mysql_select_db($mysql_db, $deletenews_connect);

	if ($drivingbook == 1) {
	
	$drivingday = date(d);
	$drivingmonth = date(m);
	$drivingyear = date(y);
	
		echo "<span style=\"letter-spacing:1; font-size:10px; color:#6daa5a;\"><b>K&oslash;rebog:</b></span>";
		echo "<span id=\"closebutton\" class=\"closebutton\" onclick=\"showwindow();\">X</span><br>";		
		echo "	<hr><br>";
		echo "	<div style=\"font-size:2px;\">&nbsp;</div>";
		
		echo "<form name=\"drivingbookform\"style=\"margin:0px; padding:0px;\">";
		echo "<label for=\"drivingdate\">Dato:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<label for=\"drivingfrom\">Fra-Adresse:</label>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<label for=\"drivingto\">Til-Adresse:</label>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<label for=\"drivingfromkm\">Km-afgang:</label>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<label for=\"drivingtokm\">Km-ankomst:</label><br>";
		echo "<input id=\"drivingdate\" readonly=\"1\" style=\"width:55px;\" class=\"newsbox\" value=\"$drivingday-$drivingmonth-$drivingyear\">";
		echo "&nbsp;<input id=\"drivingfrom\" class=\"newsbox\">";
		echo "&nbsp;<input id=\"drivingto\" class=\"newsbox\">";
		echo "&nbsp;<input id=\"drivingfromkm\" style=\"width:100px;\" class=\"newsbox\">";
		echo "&nbsp;<input id=\"drivingtokm\" style=\"width:101px;\" class=\"newsbox\">";
		echo "</form>";
	
		echo "<table class=\"drivingbook\" cellpadding=\"0\" cellspacing=\"0\">";
		echo "	<tr bgcolor=\"#fcfcfc\">";
		echo "		<td class=\"drivingtd\">";
		echo "			Date";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			Time";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			From";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			To";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			FromKM";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			ToKM";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			Benzin";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			Bonnr";
		echo "		</td>";
		echo "	</tr>";
		echo "	<tr bgcolor=\"#c3d9c2\">";
		echo "		<td class=\"drivingtd\">";
		echo "			Date";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			Time";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			From";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			To";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			FromKM";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			ToKM";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			Benzin";
		echo "		</td>";
		echo "		<td class=\"drivingtd\">";
		echo "			Bonnr";
		echo "		</td>";
		echo "	</tr>";
		echo "</table>";
	};
};
//KØREBOG -- SLUT


//CALENDAR -- START
if (isset($cal)) {
	if ($cal == 1) {
		include('calendar.php');
	};
};
//CALENDAR -- SLUT

?>