<?php
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

?>