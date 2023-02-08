<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>WOi.dk - Wave of Illusions</title>
<script type="text/javascript" language="JavaScript">
<!--
var windowwidth;
var windowheight;
var banneriframe;
var req;
var frame;
var passwindowshown = 0;
var roundoutnr;
var adminwindow;
var adminwindowshown = 0;
var templatesinfoboxshown = 0;
var windowleftpos = 0;
var windowtoppos = 0;
var oldObj;

function leftborderresize()
{
	windowheight = document.body.scrollHeight;

	document.getElementById('leftouterborder').style.height = windowheight;
	document.getElementById('leftinnerborder').style.height = windowheight;
	document.getElementById('leftspace').style.height = windowheight;
	document.getElementById('leftrightspace').style.height = windowheight;
};

function bannerresize()
{
	windowwidth = document.body.scrollWidth;
	windowheight = document.body.scrollHeight;

	banneriframe = document.getElementById('banneriframe');
	
	if (document.getElementById && !document.all) 
	{
		document.getElementById('mainframe').style.width = windowwidth - 496;
	} else {
		document.getElementById('mainframe').style.width = "100%";	
	};
	
		banneriframe.style.width = windowwidth - 415;
		
		roundoutnr = (document.getElementById('banneriframe').offsetWidth / 800) * 300;
		roundoutnr = Math.round(roundoutnr);
		
		banneriframe.style.height = roundoutnr;
	
	document.getElementById('mainframe').style.top = banneriframe.offsetHeight + 50;
	
	document.getElementById('leftouterborder').style.height = windowheight;
	document.getElementById('leftinnerborder').style.height = windowheight;
	document.getElementById('leftspace').style.height = windowheight;
	document.getElementById('leftrightspace').style.height = windowheight;
	
	document.getElementById('banneriframe').contentWindow.document.getElementById('bannerpic').style.width = banneriframe.style.width;
	document.getElementById('banneriframe').contentWindow.document.getElementById('bannerpic').style.height = banneriframe.style.height;
};

function login()
{
	var loginnick = document.getElementById('loginuser').value;
	var loginpass = document.getElementById('loginpass').value;
	
	XMLrequest('login.php?login=1&logintypeduser=' + loginnick + '&logintypedpass=' + loginpass + '', 'loginadvisor');
	
	passwindow();
	
	document.getElementById('loginuser').value = "";
	document.getElementById('loginpass').value = "";
};

function moveadminwindow()
{
	if (document.getElementById('loginadvisor').innerHTML != 'Username/password is incorrect!')
	{
		document.getElementById('mainframe').innerHTML = document.getElementById('loginadvisor').innerHTML;
		document.getElementById('loginadvisor').innerHTML = '';
	} else if (document.getElementById('loginadvisor').innerHTML == 'Username/password is incorrect!') {
		document.getElementById('loginadvisor').style.visibility = 'visible';
	}
};

function XMLrequest(url, preframe) {
	frame = preframe;
	
	req = false;
    // branch for native XMLHttpRequest object
    if(window.XMLHttpRequest) {
    	try {
			req = new XMLHttpRequest();
        } catch(e) {
			req = false;
        }
    // branch for IE/Windows ActiveX version
    } else if(window.ActiveXObject) {
       	try {
        	req = new ActiveXObject("Msxml2.XMLHTTP");
      	} catch(e) {
        	try {
          		req = new ActiveXObject("Microsoft.XMLHTTP");
        	} catch(e) {
          		req = false;
        	}
		}
    }
	if(req) {
		req.onreadystatechange = processReqChange;
		req.open("GET", url, true);
		req.send("");
	}
};

function processReqChange() {
    // only if req shows "loaded"
    if (req.readyState == 4) {
        // only if "OK"
        if (req.status == 200) {
			document.getElementById(frame).innerHTML = req.responseText;
			leftborderresize();
			if (frame == 'loginadvisor') {
				moveadminwindow();
			}

        } else {
            document.getElementById(frame).innerHTML = "There was a problem retrieving the XML data:\n" + req.statusText;
        }
    }
};

function passwindow()
{
	if (passwindowshown == 0) {
		document.getElementById('passwindow').style.visibility = "visible";
		passwindowshown = 1;
	} else {
		document.getElementById('passwindow').style.visibility = "hidden";		
		passwindowshown = 0;
	}
};
					
function showwindow(url, wwidth, wheight, overwrite)
{
	if (adminwindowshown == 0 || overwrite == '1') {
		adminwindow = document.getElementById('adminwindow');
		adminwindow.style.width = wwidth;
		adminwindow.style.height = wheight;
		adminwindow.style.visibility = 'visible';
		
		XMLrequest(url, 'adminwindow');
		
		leftborderresize();
		
		adminwindowshown = 1;
		
	} else if (adminwindowshown == 1) {
		adminwindow.style.visibility = 'hidden';
		
		adminwindowshown = 0;
	}
};

function createnews()
{
	var newsdate = document.getElementById('newsdate').value;
	var newsheader = document.getElementById('newsheader').value;
	var newsindex = document.getElementById('newsindex').value;
	var newsauthor = document.getElementById('newsauthor').value;

	adminwindow = document.getElementById('adminwindow');
	adminwindow.style.width = '191px';
	adminwindow.style.height = '25';
	
	XMLrequest('functions.php?createnews=2&newsdate=' + escape(newsdate) + '&newsheader=' + escape(newsheader) + '&newsindex=' + escape(newsindex) + '&newsauthor=' + escape(newsauthor), 'adminwindow');	
}

function updatenews(chosennewsID)
{
	var editnewsdate = document.getElementById('editnewsdate').value;
	var editnewsheader = document.getElementById('editnewsheader').value;
	var editnewsindex = document.getElementById('editnewsindex').value;
	var editnewsauthor = document.getElementById('editnewsauthor').value;
	
	adminwindow = document.getElementById('adminwindow');
	adminwindow.style.width = '191px';
	adminwindow.style.height = '25';
	
	XMLrequest('functions.php?editnews=3&editnewsdate=' + escape(editnewsdate) + '&editnewsheader=' + escape(editnewsheader) + '&editnewsindex=' + escape(editnewsindex) + '&editnewsauthor=' + escape(editnewsauthor) + '&variableID=' + chosennewsID, 'adminwindow');	
}

function editnewswindow(url, wwidth, wheight, overwrite)
{
	var headerID = document.editnewslist.newsheader.options[document.editnewslist.newsheader.selectedIndex].value;
	var url2 = url + '&chosennewsID=' + headerID;

	showwindow(url2, wwidth, wheight, overwrite);
};

function deletenews()
{
	var headerID = document.deletenewslist.newsheader.options[document.deletenewslist.newsheader.selectedIndex].value;
	var url2 = 'functions.php?deletenews=2&chosennewsID=' + headerID;

	showwindow(url2, '191', '25', '1');
};

function showtemplatesinfobox(obj, overwrite)
{
	var templatesbox = document.getElementById('templatesbox').style;
		document.getElementById('templatesbox').innerHTML = "Loading...";
	
	if (templatesinfoboxshown == 0 || obj != oldObj && overwrite != 1) {
		oldObj = obj;	
			
		var infolinkleft = 8;
		var infolinktop = -400;
		
		while (obj.offsetParent) {
			infolinkleft += obj.offsetLeft;
			infolinktop += obj.offsetTop;
			obj = obj.offsetParent;
		}
	
		templatesbox.left = infolinkleft + "px";
		templatesbox.top = infolinktop + "px";
		templatesbox.visibility = "visible";
		templatesinfoboxshown = 1;
	} else {
		templatesbox.visibility = "hidden";
		templatesinfoboxshown = 0;		
	};
};

function zoomtemplates(nr, header)
{
	var zoomimage = "functions.php?templates=zoom&templateheader=" + header + "&templatenr=" + nr;
	
	zoomwindow = window.open(zoomimage, 'ZoomWindow', 'height=600,width=800,scrollbars=yes');
	if (window.focus) {zoomwindow.focus()}; 
};

function zoomnotebooks(nr, header)
{
	var zoomimage = "functions.php?notebooks=zoom&notebookheader=" + header + "&notebooknr=" + nr;
	
	zoomwindow = window.open(zoomimage, 'ZoomWindow', 'height=600,width=800,scrollbars=yes');
	if (window.focus) {zoomwindow.focus()}; 
};

function bannerchange(site) {
	var bannerwidth = document.getElementById('banneriframe').style.width;
	var bannerheight = document.getElementById('banneriframe').style.height;
	var bannerlocation = 'functions.php?bannerwidth=' + bannerwidth + '&bannerheight=' + bannerheight + '&banner=' + site;
	parent.frames[1].location.href = bannerlocation; 
};

-->
</script>
<meta name="generator" content="TSW WebCoder">
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body onload="bannerresize(); XMLrequest('functions.php?news=1', 'newsboxdiv');">

<span class="leftouterborder" id="leftouterborder"></span>

<img src="pics/site/leftspace.jpg" alt="leftspace" class="leftspace" id="leftspace">

<span class="leftinnerborder" id="leftinnerborder"></span>

<img src="pics/site/leftrightspace.jpg" alt="leftrightspace" class="leftrightspace" id="leftrightspace">

<span class="topbanner"></span>

<span class="topbannerspace">&nbsp;</span>

<img src="pics/site/newsbox.jpg" alt="newsbox" class="newsbox">

<div id="newsboxdiv" class="newsboxdiv"></div>

<span class="newsboxunderspace">&nbsp;</span>

<img src="pics/site/searchbox.jpg" alt="searchbox" class="searchbox">

<span class="searchboxunderspace">&nbsp;</span>

<span class="innerrightspace"></span>

<!-- OFFERBOX - START !-->
<img src="pics/site/offerbox.jpg" alt="offerbox" class="offerbox">

<div id="offerbox">
<?php
		$offerfile = 'toshibar200';

		$maindir = getcwd();
		$picsdir = "pics/offerbox/$offerfile";
		$wdir = $maindir . "/" . $picsdir;
		
		$totalpics = 0;
		
		if (is_dir($wdir)) {
			$openeddir = opendir($wdir);
			
			while (($file = readdir($openeddir)) !== false) {
				if (!is_dir($wdir . '/'. $file)) {
					$totalpics ++;
				};
			};
		};
		closedir($openeddir);
?>

<?php
echo "<iframe src=\"offerpic.php?offerfile=$offerfile&offerpicnr=1\" class=\"offerpiciframe\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\" scrolling=\"no\" name=\"offerpiciframe\"></iframe>";
?>

<?php 
echo "<a id=\"offerpicprev\" href=\"offerpic.php?offerfile=$offerfile&offerpicnr=$totalpics&direction=prev&totalpics=$totalpics\" target=\"offerpiciframe\">";
?>
	  	<img src="pics/site/offerboxpicprev.jpg" border="0" height="9" width="9" style="cursor:pointer; position:absolute; top:408px; right:37px; z-index:102;">
	  </a>


<?php 
echo "<a id=\"offerpicnext\" href=\"offerpic.php?offerfile=$offerfile&offerpicnr=2&direction=next&totalpics=$totalpics\" target=\"offerpiciframe\">";
?>
		<img src="pics/site/offerboxpicnext.jpg" border="0" height="9" width="9" style="cursor:pointer; position:absolute; top:408px; right:22px; z-index:102;">
	  </a>


<?php
	include('offerboxhtml/' . $offerfile . '.php');
?>
</div>
<!-- OFFERBOX - SLUT !-->

<table cellpadding="0" cellspacing="0" border="0" class="menu" background="pics/site/menu.jpg">
  <tr>
  	<td height="30" onclick="XMLrequest('functions.php?site=produkter&subsite=produkter', 'mainframe'); bannerchange('0002');" style="cursor:pointer;"></td>
  </tr>
  <tr>
  	<td height="28" onclick="XMLrequest('functions.php?site=profil&subsite=profil', 'mainframe')" style="cursor:pointer;"></td>
  </tr>
  <tr>
  	<td height="28" onclick="XMLrequest('functions.php?site=templates&subsite=templates', 'mainframe')" style="cursor:pointer;"></td>
  </tr>
  <tr>
  	<td height="28" onclick="XMLrequest('functions.php?site=links&subsite=links', 'mainframe')" style="cursor:pointer;"></td>
  </tr>
  <tr>
  	<td height="29" onclick="XMLrequest('functions.php?site=kontakt&subsite=kontakt', 'mainframe')" style="cursor:pointer;"></td>
  </tr>
</table>

<div class="logo" id="logo">
	<div style="height:142px; width:246px; background-color:#FFFFFF; position:absolute; z-index:20; top:0px; left:2px;"></div>
	<div id="logoshadow1" style="height:142px; width:246px; background-color:#000000; position:absolute; z-index:10; top:3px; left:5px; filter:alpha(opacity=25); -moz-opacity:0.25;"></div>

	<div style="height:138px; width:250px; background-color:#FFFFFF; position:absolute; z-index:20; top:2px; left:0px;"></div>
	<div id="logoshadow2" style="height:138px; width:250px; background-color:#000000; position:absolute; z-index:10; top:5px; left:3px; filter:alpha(opacity=25); -moz-opacity:0.25;"></div>

	<div id="logoshadow3" style="height:140px; width:248px; background-color:#000000; position:absolute; z-index:10; top:4px; left:4px; filter:alpha(opacity=25); -moz-opacity:0.25;"></div>
	<img src="pics/site/logo.jpg" style="position:absolute; top:1px; left:1px; z-index:20;">
</div>

<iframe src="functions.php?banner=0001" scrolling="no" frameborder="0" name="banneriframe" id="banneriframe" class="banner"></iframe>

<a href="" target="_blank"><img src="pics/site/sitemap.jpg" alt="sitemap" class="sitemappic"></a>

<a href=""><img src="pics/site/home.jpg" alt="home" class="homepic"></a>

<img src="pics/site/login.jpg" alt="login" class="loginpic" style="cursor:pointer;" onclick="passwindow();">


<span class="mainframe" id="mainframe">
	<span id="forsidelink" class="linkbanner" onclick="XMLrequest('functions.php?site=welcome&subsite=welcome', 'mainframe');"><u>Forside</u></span><br><br>
	<?php include("welcome.php"); ?>
</span>


<form method="get" action="functions.php" id="searchform">
  <input type="text" class="searchform"><img src="pics/site/searchbutton.jpg" alt="searchbutton" class="searchbutton">
</form>

<div id="passwindow" class="passwindow">
	<form name="loginbox" method=get" action="functions.php" style="position: relative; top: 5px; margin: 0px;">
		<label for="username" style="color: #FFFFFF; position: relative; left: 5px;">Brugernavn:</label>
		<input type="text" class="passform" id="loginuser">
		<label for="pass" style="color: #FFFFFF; position: relative; left: 5px;">Kodeord:</label>
		<input type="password" class="passform" id="loginpass">
			<span style="padding-left:82px; cursor:pointer; font-size:9px; color:#FFFFFF;" onclick="login();">
				:: login ::
			</span>
	</form>
</div>

<div id="loginadvisor" class="loginadvisor"></div>

</body>
</html>