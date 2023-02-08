<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Calendar</title>
<meta name="generator" content="TSW WebCoder">
<meta http-equiv="Cache-Control" Content="no-cache"> 


<style type="text/css">
textarea {
	border: 0px;
	width: 100%;
	scrollbar-base-color:#333333;
	scrollbar-face-color:#CCCCCC;
	scrollbar-shadow-color:#333333;
	scrollbar-darkshadow-color:#CCCCCC;
	scrollbar-highlight-color:#999999;
	scrollbar-arrow-color:#000000;
	scrollbar-3dlight-color:#000000;
	font-family: verdana, tahoma;
	font-size: 10px;
}
</style>

</head>

<?php

$montharray = array("", "januar", "februar", "marts", "april", "maj", "juni", "juli", "august", "september", "oktober", "november", "december");

if (!isset($month)) {
	$selectday = date('d');
	$month = date('n');
	$year = date('Y');
};

//Next Month Script START
	$nextmonth = $month + 1;
	$nyear = $year;
	if ($nextmonth > 12) {
		$nyear = $year + 1;
		$nextmonth = 1;
	}
//NEXT Month Script SLUT


//Previous Month Script START
	$prevmonth = $month - 1;
	$pyear = $year;
	if ($prevmonth < 1) {
		$pyear = $year - 1;
		$prevmonth = 11;
	}
//Previous Month Script SLUT
?>

<body bgcolor="#676767">

<?php

	if(isset($remind)) {
		echo "<table cellpadding=\"0\" cellspacing=\"2\">";
		$remindcal_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
		mysql_select_db($mysql_db);
		$remindresult = mysql_query("select header, id, type from calendar where day=$remindday && month=$remindmonth && year=$remindyear order by id asc;");
		$remindNR = 0;
				
		while ($remindarray = mysql_fetch_array($remindresult)) {
				$remindID = $remindarray['id'];
				$remindNR1 = $remindNR + 1;
				$remindPIC = $remindarray['type'];
				echo "<tr>";
				echo "<td id=\"mainDiv$remindNR1\" style=\"cursor:hand; font-size:10px; font-family:verdana,tahoma; color:#000000;\">&nbsp;&nbsp;$remindNR1:&nbsp;&nbsp;";
				echo $remindarray['header'];
				echo "&nbsp;&nbsp;<img border=\"0\" src=\"pics/$remindPIC.gif\"></img>";
				echo "</td>";
				echo "</tr>";
			
			$remindNR++;
		};
		
		unset($remind);
		mysql_close($remindcal_connect);
		
		echo "</table>";
	
	} elseif(isset($new)) {
		
		echo "<form action=\"cal.php?create=1\" method=\"post\">";
		echo "<input style=\"filter:alpha (opacity:75); border:1px #000000 solid; width:67px; font-family:verdana,tahoma; font-size:10px;\" name=\"date\" readonly=\"1\" value=\"$day-$month-$year\">";
		echo "<input style=\"filter:alpha (opacity:75); border:1px #000000 solid; width:87px; font-family:verdana,tahoma; font-size:10px;\" name=\"header\" maxlength=\"50\">";
		echo "<br>";
		echo "<textarea style=\"filter:alpha (opacity:75); border:1px #000000 solid; height:129px; width:158px; font-family:verdana,tahoma; font-size:10px;\" name=\"main\"></textarea>";
		echo "<input type=\"submit\" value=\"Opret\" style=\"font-family:verdana,tahoma; font-size:10px; height:18px; width:67px; border:1px #000000 solid;\">";
		echo "<br><input type=\"radio\" name=\"type\" value=\"meeting\" checked><img style=\"border:0px solid #000000;\" src=\"pics/meeting.gif\"></img>";		
		echo "&nbsp;&nbsp;<input type=\"radio\" name=\"type\" value=\"birthday\"><img style=\"border:1px solid #000000;\" src=\"pics/birthday.gif\"></img>";
		echo "&nbsp;&nbsp;<input type=\"radio\" name=\"type\" value=\"holiday\"><img style=\"border:0px solid #000000;\" src=\"pics/holiday.gif\"></img>";
		echo "<input type=\"hidden\" name=\"day\" value=\"$day\">";
		echo "<input type=\"hidden\" name=\"month\" value=\"$month\">";
		echo "<input type=\"hidden\" name=\"year\" value=\"$year\">";
		echo "</form>";
		
		unset($new);
		
	} elseif(isset($view)) {
		
		$viewcal_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
		mysql_select_db($mysql_db);
		$viewresult = mysql_query("select header, id, type from calendar where day=$day && month=$month && year=$year order by id asc;");
		$viewNR = 1;			
			
			echo "<div style=\"font-size:8px; font-family:verdana,tahoma; color:#000000;\">&nbsp;</div>";
			echo "<div style=\"font-size:10px; font-family:verdana,tahoma; color:#000000;\" align=\"center\"><b>Aftaler: $day-$month-$year</b></div>";
		
		while ($viewarray = mysql_fetch_array($viewresult)) {
			$viewID = $viewarray['id'];
			$viewPIC = $viewarray['type'];
			echo "<div style=\"font-size:4px; font-family:verdana,tahoma; color:#000000;\">&nbsp;</div>";
			echo "<div style=\"font-size:10px; font-family:verdana,tahoma; color:#000000;\">&nbsp;&nbsp;$viewNR:&nbsp;&nbsp;";
			echo "<a href=\"cal.php?viewchosen=1&id=$viewID&day=$day&month=$month&year=$year\" onmouseover=\"this.style.color='#cccccc';\" onmouseout=\"this.style.color='#000000';\" style=\"font-size:10px; font-family:verdana,tahoma; color:#000000; text-decoration:none;\">";
			echo $viewarray['header'];
			echo "</a>";
			echo "&nbsp;&nbsp;<img border=\"0\" src=\"pics/$viewPIC.gif\"></img>";
			echo "</div>";
			
			$viewNR++;
		};
		
		unset($view);
		mysql_close($viewcal_connect);
	
	} elseif(isset($viewchosen)) {
		
		$viewcal_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
		mysql_select_db($mysql_db);
		$viewresult = mysql_query("select header, main, type from calendar where id=$id;");

		while ($viewarray = mysql_fetch_array($viewresult)) {
			$viewheader = $viewarray['header'];
			$chosendatetextunrated = $viewarray['main'];
			$chosendatetext = nl2br("$chosendatetextunrated");
			$viewchosenPIC = $viewarray['type'];
			echo "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\">";
			echo "	<tr>";
			echo "		<td>";
			echo "			<div style=\"font-size:5px; font-family:verdana,tahoma; color:#000000;\">&nbsp;</div>";
			echo "			<div style=\"font-size:10px; font-family:verdana,tahoma; color:#000000;\" align=\"center\"><b>Aftaler: $day-$month-$year</b></div>";
			echo "		</td>";
			echo "	</tr>";
			
			echo "	<tr>";
			echo "		<td>";
			echo "			<img border=\"0\" src=\"pics/$viewchosenPIC.gif\"></img>&nbsp;";
			echo "			<span style=\"font-size:10px; font-family:verdana,tahoma; color:#000000; text-decoration:underline;\">";
			echo "				$viewheader:";
			echo "			</span>";
			echo "		</td>";
			echo "	</tr>";
	
			echo "	<tr>";
			echo "		<td>";
			echo "			<div style=\"padding-left:5px; font-size:10px; font-family:verdana,tahoma; color:#000000;\">";
			echo $chosendatetext;
			echo "			</div>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}
		
		unset($viewchosen);
		mysql_close($viewcal_connect);
		
	} elseif(isset($delchosen)) {
		$delchosen_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
		mysql_select_db($mysql_db);
		$delchosenresult = mysql_query("select header, id from calendar where day=$day && month=$month && year=$year order by id asc;");
		$delchosenNR = 1;			
		
			echo "<div style=\"font-size:8px; font-family:verdana,tahoma; color:#000000;\">&nbsp;</div>";
			echo "<div style=\"font-size:10px; font-family:verdana,tahoma; color:#000000;\" align=\"center\"><b>Slet: $day-$month-$year</b></div>";
		
		while ($delchosenarray = mysql_fetch_array($delchosenresult)) {
			$delchosenID = $delchosenarray['id'];
			echo "<div style=\"font-size:4px; font-family:verdana,tahoma; color:#000000;\">&nbsp;</div>";
			echo "<div style=\"font-size:10px; font-family:verdana,tahoma; color:#000000;\">&nbsp;&nbsp;$delchosenNR:&nbsp;&nbsp;";
			echo "<a href=\"cal.php?del=1&id=$delchosenID&day=$day&month=$month&year=$year\" onmouseover=\"this.style.color='#cccccc';\" onmouseout=\"this.style.color='#000000';\" style=\"font-size:10px; font-family:verdana,tahoma; color:#000000; text-decoration:none;\">";
			echo $delchosenarray['header'];
			echo "</a>";
			echo "</div>";
			
			$delchosenNR++;
		};
		
		unset($delchosen);
		mysql_close($delchosen_connect);
	} elseif (isset($create)) {
		
			$createcal_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
			mysql_select_db($mysql_db);
	
		
			$createcal_day = $GLOBALS['day'];
			$createcal_month = $GLOBALS['month'];
			$createcal_year = $GLOBALS['year'];
			$createcal_header = $GLOBALS['header'];
			$createcal_main = $GLOBALS['main'];
			$createcal_type = $GLOBALS['type'];
	
			mysql_query("insert into `calendar` (day, month, year, `header`, `main`, `type`) values ($createcal_day, $createcal_month, $createcal_year, '$createcal_header', '$createcal_main', '$createcal_type');");
			mysql_close($createcal_connect);

			echo "<div style=\"font-size:10px; font-family:verdana,tahoma; color:#000000;\"><br><br><br>Aftalen er oprettet..</div>";
			echo "<a href=\"cal.php?view=1&day=$day&month=$month&year=$year\" onmouseover=\"this.style.color='#cccccc';\" onmouseout=\"this.style.color='#000000';\" style=\"font-size:10px; font-family:verdana,tahoma; color:#000000; text-decoration:none;\">";
			echo "	Gå tilbage til oversigt";
			echo "</a>";
			
			unset($create);
		} elseif(isset($del)) {
			
			$delcal_connect = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
			mysql_select_db($mysql_db);
			
			mysql_query("delete from `calendar` where id=$id");	
			mysql_close($delcal_connect);
			
			echo "<div style=\"font-size:10px; font-family:verdana,tahoma; color:#000000;\"><br><br><br>Aftalen er blevet slettet..</div>";
			echo "<a href=\"cal.php?view=1&day=$day&month=$month&year=$year\" onmouseover=\"this.style.color='#cccccc';\" onmouseout=\"this.style.color='#000000';\" style=\"font-size:10px; font-family:verdana,tahoma; color:#000000; text-decoration:none;\">";
			echo "	Gå tilbage til oversigt";
			echo "</a>";
			
			unset($del);
		
		} else {
?>

<table border="0" cellpadding="4" cellspacing="4" style="font-size:10px; font-family:verdana,tahoma; color:#000000;">
	<tr>
		<td colspan="7" align="center">
<?php			
			echo "<a id=\"prevmonth\" href=\"cal.php?selectday=$selectday&month=$prevmonth&year=$pyear\"><img src=\"pics/startmenu/calprevmonth.jpg\" border=\"0\" width=\"8\" height=\"7\"></a>";
			echo "	&nbsp;<b>" . $montharray[$month] . "&nbsp;" . $year . "</b>&nbsp;";
			echo "<a id=\"nextmonth\" href=\"cal.php?selectday=$selectday&month=$nextmonth&year=$nyear\"><img src=\"pics/startmenu/calnextmonth.jpg\" border=\"0\" width=\"8\" height=\"7\"></a>";
?>
		</td>
	</tr>
	<tr align="center">
		<td>
			ma
		</td>
		<td>
			ti
		</td>
		<td>
			on
		</td>
		<td>
			to
		</td>
		<td>
			fr
		</td>
		<td>
			l&aring;
		</td>
		<td>
			s&oslash;
		</td>
	</tr>
<?php
	
	$weekday = date("w", mktime(0, 0, 0, $month, 1, $year));
	if ($weekday == 0) {
		$weekday = 7;
	}

	$tr_start_ticker = 1;
	$tr_end_ticker = 7;
	
	if ($weekday == 1) {
		$tr_end_ticker = 8;
	}
	
	$ticker = 1;
	$tickerday = 1;
	
	while ($tickerday < 32) {
		if (checkdate($month, $tickerday, $year) == true) {
		
		$calmonthconnection = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
		mysql_select_db($mysql_db);
		$monthresult = mysql_query("select day from calendar where day=$tickerday && month=$month;");
			$monthrow = mysql_fetch_array($monthresult);
		
			if ($ticker == $tr_start_ticker) {
				if ($ticker == $weekday) {
					$weekday ++;
				} elseif ($ticker != $weekday) {
					echo "<tr><td>&nbsp;</td>";
				} elseif ($tickerday == $selectday) {
					echo "<tr><td id=\"$tickerday\" onmousedown=\"rightmenu('$tickerday', '$month', '$year');\" align=\"center\" style=\"background-image: url(pics/startmenu/calSelect.jpg);\">";
					echo "<div style=\"color:#000000; cursor:default;\"><b>$tickerday</b></div></td>";
					$tickerday += 1;
					$weekday += 1;
				} else {			
					echo "<tr><td id=\"$tickerday\" align=\"center\" style=\"background-image: url();\">";
					
					if ($monthrow['day'] != NULL) {
						echo "	<a style=\"text-decoration:none; font-style:none; color:#000000;\" id=\"choosedate\" href=\"cal.php?selectday=$tickerday&month=$month&year=$year\">$tickerday</a>";					
					} else {
						echo "	<a style=\"text-decoration:none; font-style:none; color:#000000;\" id=\"choosedate\" href=\"cal.php?selectday=$tickerday&month=$month&year=$year\">$tickerday</a>";					
					};
				
					echo "</td>";
					$tickerday += 1;
					$weekday += 1;
				};
				
				$tr_start_ticker += 8;
				$ticker += 1;
				
			} elseif ($ticker == $tr_end_ticker) {
				if ($tickerday == $selectday) {
					echo "<td id=\"$tickerday\" onmousedown=\"rightmenu('$tickerday', '$month', '$year');\" align=\"center\" style=\"background-image: url(pics/startmenu/calSelect.jpg);\">";
					echo "<div style=\"color:#000000; cursor:default;\"><b>$tickerday</b></div></td></tr>";
				} else {
					echo "<td id=\"$tickerday\" align=\"center\" style=\"background-image: url();\">";

					if ($monthrow['day'] != NULL) {
						echo "	<a style=\"text-decoration:none; font-style:none; color:#000000;\" id=\"choosedate\" href=\"cal.php?selectday=$tickerday&month=$month&year=$year\">$tickerday</a>";					
					} else {
						echo "	<a style=\"text-decoration:none; font-style:none; color:#000000;\" id=\"choosedate\" href=\"cal.php?selectday=$tickerday&month=$month&year=$year\">$tickerday</a>";					
					};

					echo "</td></tr>";
				};
				
				$tr_end_ticker += 8;
				$ticker += 1;
				$tickerday += 1;
				$weekday += 1;
				
			} else {
				if ($ticker != $weekday) {
					echo "<td>&nbsp;</td>";
				} elseif ($tickerday == $selectday) {
					echo "<td id=\"$tickerday\" onmousedown=\"rightmenu('$tickerday', '$month', '$year');\" align=\"center\" style=\"background-image: url(pics/startmenu/calSelect.jpg);\">";
					echo "<div style=\"color:#000000; cursor:default;\"><b>$tickerday</b></div></td>";
					$tickerday += 1;
					$weekday += 1;
				} else {
					echo "<td id=\"$tickerday\" align=\"center\" style=\"background-image: url();\">";

					if ($monthrow['day'] != NULL) {
						echo "	<a style=\"text-decoration:none; font-style:none; color:#000000;\" id=\"choosedate\" href=\"cal.php?selectday=$tickerday&month=$month&year=$year\">$tickerday</a>";					
					} else {
						echo "	<a style=\"text-decoration:none; font-style:none; color:#000000;\" id=\"choosedate\" href=\"cal.php?selectday=$tickerday&month=$month&year=$year\">$tickerday</a>";					
					};

					echo "</td>";
					$tickerday += 1;
					$weekday += 1;
				};

				$ticker += 1;
			};
		} else {
		return false;
		};
	};
?>


</table>


<?php
	mysql_close($calmonthconnection);
};
?>

</body>
</html>