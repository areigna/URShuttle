<!DOCTYPE html> 
<?php include('function.php'); ?>
<html> 
<head> 
	<link rel="icon" type="image/ico" href="image/icon.png"></link> 
	<link rel="shortcut icon" href="image/icon.png"></link>
	<meta charset="UTF-8">
	<title>URShuttle</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript" src="jquery.cookie.js"></script>
	<?php include('js.php'); ?>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
<style type="text/css">
.ui-icon-facebook{
	background-image: url("image/facebook.png");
}
.ui-icon-reverse{
	background-image: url("image/reverse.png");
}
.ui-icon-skull{
	background-image: url("image/skull.png");
}
@media only screen and (-webkit-min-device-pixel-ratio: 2) {
	.ui-icon-reverse {
		background-image: url("image/reverseIphone.png");
		background-size: 18px 18px;
	}
}
</style>
</head>
<body> 
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
