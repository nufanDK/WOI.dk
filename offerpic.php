<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title></title>
<meta http-equiv="Page-Enter" content="blendTrans(Duration=1.0)">
<meta http-equiv="Page-Exit" content="blendTrans(Duration=1.0)">
<meta name="generator" content="TSW WebCoder">
<script type="text/javascript" language="JavaScript">
<!--
var prevofferpicnr;
var nextofferpicnr;

function changeofferpic(direction, offerfile, offerpicnr, totalpics)
{
			    if (direction == 'prev') {
			    	if (offerpicnr == totalpics) {
			    		nextofferpicnr = 1;
			    		prevofferpicnr = totalpics - 1;
			    	} else if (offerpicnr == 1) {
			    		nextofferpicnr = offerpicnr + 1;
			    		prevofferpicnr = totalpics;
			    	} else {
				    	nextofferpicnr = offerpicnr + 1;
			    		prevofferpicnr = offerpicnr - 1;
			    	}
			    } else if (direction == 'next') {
			    	if (offerpicnr == totalpics) {
			    		nextofferpicnr = 1;
			    		prevofferpicnr = totalpics - 1;
			    	} else if (offerpicnr == 1) {
			    		nextofferpicnr = offerpicnr + 1;
			    		prevofferpicnr = totalpics;
			    	} else {
				    	nextofferpicnr = offerpicnr + 1;
			    		prevofferpicnr = offerpicnr - 1;
			    	}
			    }
	
	parent.offerpicprev.href = 'offerpic.php?offerfile=' + offerfile + '&offerpicnr=' + prevofferpicnr + '&direction=prev&totalpics=' + totalpics;
	parent.offerpicnext.href = 'offerpic.php?offerfile=' + offerfile + '&offerpicnr=' + nextofferpicnr + '&direction=next&totalpics=' + totalpics;
}

function zoomnotebooks(nr, header)
{
	var zoomimage = "functions.php?notebooks=zoom&notebookheader=" + header + "&notebooknr=" + nr;
	
	zoomwindow = window.open(zoomimage, 'ZoomWindow', 'height=600,width=800,scrollbars=yes');
	if (window.focus) {zoomwindow.focus()}; 
};

-->
</script>
</head>

<?php
if (!isset($direction)) {
echo "<body style=\"margin:0px;\">";
} else {
echo "<body onload=\"changeofferpic('$direction', '$offerfile', $offerpicnr, '$totalpics');\" style=\"margin:0px;\">";
};

echo "<img src=\"pics/offerbox/$offerfile/$offerpicnr.jpg\" onclick=\"zoomnotebooks('2', 'Toshiba R200');\" border=\"0\" height=\"108\" width=\"150\" style=\"cursor:pointer; display:block;\">";

?>


</body>
</html>