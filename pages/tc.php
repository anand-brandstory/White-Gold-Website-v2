<?php

/*
 |
 | Analytics
 | 	- This page simply loads Google Tag Manager.
 | 	- It is used to capture virtual page views on Google Analytics.
 | 	- Essentially, this page is opened within an iframe, long enough to register a "hit", before then being closed.
 |
 */

?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">

	<title></title>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TLN9437');</script>
	<!-- End Google Tag Manager -->

</head>

<body>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TLN9437"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

</body>

</html>