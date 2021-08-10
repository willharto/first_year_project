<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  </script>
  <script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js">
  </script>
  <link href="take_files.css" rel="stylesheet" type="text/css">

  <script type="">
  	var isChromium = window.chrome;
	var winNav = window.navigator;
	var vendorName = winNav.vendor;
	var isOpera = typeof window.opr !== "undefined";
	var isIEedge = winNav.userAgent.indexOf("Edge") > -1;
	var isIOSChrome = winNav.userAgent.match("CriOS");
	var browser = "";

	if (isIOSChrome) {
	   // is Google Chrome on IOS
	} else if(
	  isChromium !== null &&
	  typeof isChromium !== "undefined" &&
	  vendorName === "Google Inc." &&
	  isOpera === false &&
	  isIEedge === false
	) {
	   browser = "chrome";
	}
  </script>

</head>

<body>

	<div class="header"><img alt="iClarity logo" class="iClarity-logo" src="../../../Choose-industry/Icons/iClarity-logo.png"> </div>

	<img class="loading-gif" src="loading.gif" />
	<script type="text/javascript">

	if (browser == "chrome"){
	location.replace('generatePDF_chrome.php');	
	}else{
	location.replace('generatePDF.php');
	}

	</script>


	
</body>
</html>