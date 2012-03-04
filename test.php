<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<form method="get" action="http://www.google.com/search">
	 <input type="text" name="q" size="30" x-webkit-speech />
	 <input type="submit" value="Google Search" />
	</form>
	<?php
include('station.php');
mysql_connect("mysql.aressera.com", "areigna", "52951810");
mysql_select_db("urshuttle_com");

	$query = "SELECT distinct email FROM maillist where email = 'hchen42@u.rochester.edu'";
	$results = mysql_query($query);
	$counter = 0;
	$maillist="";
		//echo "<li data-role='list-divider'>recent</a>";
	while($row = mysql_fetch_array($results)){
		$counter++;
		$maillist = $maillist.$row[0].",";
	}
	$arr = explode(",",$maillist);
//print_r($arr);
		//echo $row[0].",";
//define the receiver of the email
for($i=0;$i<1;$i++){
	$to = $arr[$i];

////define the subject of the email
$subject = 'U of R Bus Realtime Schedule--urshuttle.com'; 

////define the message to be sent. Each line should be separated with \n
$message = "\nURshuttle.com tells the Time for the NEXT blue,green,silver,red,gold lines to your destination according to current time. \n\nCheck http://urshuttle.com by computer or mobile.\n\n\n(going to Marketplace,RRL,Eastman,dorm or....? go check it!)"; 
////define the headers we want passed. Note that they are separated with \r\n
$headers = "From: urshuttle@urshuttle.com";
////send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
////if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
//echo $row[0];
echo $mail_sent ? "Mail sent" : "Mail failed";
echo $to;
}
	?>
</body>
</html>
