<?php
include('station.php');
mysql_connect("mysql.aressera.com", "areigna", "52951810");
mysql_select_db("urshuttle_com");
if($_GET['shortcut']){
	$addQuery = "insert into temp values ('".$_COOKIE['id']."')";
	mysql_query($addQuery);
}
//In HomePage
	//navbar text
	$from = "From?"; $to = "To?";
	//arguments for database searching
	$fromStation = "From?"; $toStation = "To?";
	//navbar width
	$navWidth = "width:50%";
	//navbar icon
	$iconFrom = "search"; $iconTo = "search";
	//navbar highlight
	$navbar = "class='ui-btn-active'";
	//right button text & Icon
	$rightBtn = "CHECK"; $rightIcon = "arrow-r";
	//display stationlist or not
	$styleStation = "";
	//display reverse buttom ot not
	$reverseNav = "";
	//display clear or back
	$clearText ="Clear All";$clearIcon = "delete";

//In RESULT page
if($_GET['from']&&$_GET['to']){
	//navbar text
	$from = $_GET['from']; $to = $_GET['to'];
	//argument to database search
	$fromStation = $_GET['from']; $toStation = $_GET['to'];
	//navbar width
	$navWidth = "width:45%";
	//navbar icon
	$iconFrom = "home"; $iconTo = "check";
	//navbar highlight
	$navbar =""; 
	//right button text & icon
	$rightBtn = "Refresh"; $rightIcon = "refresh";
	//display stationlist or not
	$styleStation = "display:none";
	//display reverse or not
	$reverseNav = "<li style='width:10%'><a href='#' data-icon='reverse' id='reverse' style='color:#dddddd'>R</a></li>";
	//display clear or back
	$clearText ="Back";$clearIcon = "arrow-l";

}

//get the current time
date_default_timezone_set('America/New_York');
$date = getdate(time());
$sec = $date['seconds'];
$min = $date['minutes'];
$hour = $date['hours'];
$day = $date['weekday'];

//echo date('y-m-d h:i:s'.' ');

//function to print history line
function historyPrint($from,$to){
	switch ($from){
		case "RRL/Rush Rhees Library":$fromT = "RRL";break;
		case "Southside,Park Lot,University Park":$fromT = "Southside,Parklot,UPK";break;
		case "Eastman,Eastman Living Center":$fromT = "Eastman";break;
		case "Riverview,Riverview/Brooks Landing":$fromT = "Riverview/BL";break;
		default : $fromT = $from;
	}
	switch ($to){
		case "RRL/Rush Rhees Library":$toT = "RRL";break;
		case "Southside,Park Lot,University Park":$toT = "Southside,Parklot,UPK";break;
		case "Eastman,Eastman Living Center":$toT = "Eastman";break;
		case "Riverview,Riverview/Brooks Landing":$toT = "Riverview/BL";break;
		default : $toT = $to;
	}
	echo "<li class='stationLi' class='historyLi' data-icon='' style='border-left:0px solid grey;border-bottom:0px solid grey'>";
	echo "<a href='#' from = '".$from."' to = '".$to."' style = 'color:black' class='history'>";//8a4b08
	//echo "<img class='ui-li-icon' alt='icon' src='http://cdn1.iconfinder.com/data/icons/diagona/icon/16/031.png' />";
	echo "☆ ".$fromT." ⇒ ".$toT."</a></li>";
}
////////////////////////////
////////////////////////////
//print the history search route
function history(){
	//list divider
	//echo "<li  style='text-align:center' class='stationLi' data-role='list-divider' data-icon='plus'>Favourite Route</li>";
	//check COOKIE first
	//check id
	if(isset($_COOKIE['id'])){
		$historyQuery = "SELECT distinct * FROM single where id = ".$_COOKIE['id']." order by number desc";
		$historyResults = mysql_query($historyQuery);
		//print 3 times
		$historyCount = 0;
		while($historyCount<3&&($historyRow = mysql_fetch_array($historyResults))){
			historyPrint($historyRow['from'],$historyRow['to']);
			$historyCount++;
		}
	}
}

//print stations
function station(){
	//frequent search
	history();
	//echo "<li data-role='' data-icon='info' data-theme='c'>⇧can't find the station? ⇧use the search bar⇧";//⇡SEARCH⇡  or  ⇣CLICK⇣ Stations</li>";
	//echo "<div class='fb-like' data-href='http://facebook.com/urshuttle' data-send='false' data-layout='button_count' data-width='450' data-show-faces='false'></div>";
	//echo "</li>";
	//list divider
	//echo "<li  style='text-align:center' class='stationLi' data-role='list-divider' data-icon='plus'>Stations</li>";
	$query = "SELECT * FROM popular p join singleStation s on p.station = s.station where s.id = '".$_COOKIE['id']."' order by s.number desc, p.click desc";
	$results = mysql_query($query);
	//if error happens, no cookie at all
	if(!$row = mysql_fetch_array($results)){//notice here fetch information already,dont fetch it second time
		$query = "SELECT * FROM popular order by click desc";
		$results = mysql_query($query);
		$row = mysql_fetch_array($results);
	}
	//the first row, with top border
	echo "<li class='stationLi' style='border-top:1px solid grey' data-icon='plus'><a href='#' style = '' class='station'>".$row[0]."</a>";
	//the rest
	while($row = mysql_fetch_array($results)){
		echo "<li class='stationLi' data-icon='plus'><a href='#' class='station'>".$row[0]."</a>";
	}
}

function fetch($from,$to){

	//get the current time
	date_default_timezone_set('America/New_York');
	$date = getdate(time());
	$sec = $date['seconds'];
	$min = $date['minutes'];
	$hour = $date['hours'];
	$day = $date['weekday'];

	//convert day to integer
	//consider the 00:00-4:00 situation
	if($hour<5){
		$day = (dayConvert($day)+5)%7+1;//get the previous day
		$hour += 24;//consider it as 25 hour of the previousday
	}
	else
		$day = dayConvert($day);
	//consider sunday 7 and monday 1 order
	if($day==7)
		$order = "desc";
	else
		$order = "asc";

	//get the information
	echo "<ul data-role='listview' data-dividertheme='c' id='schedule'>";
	//prompt for bookmarking
	//echo "<li data-role='list-divider' style='border-bottom:1px solid black;border-left:5px solid black;'>Annoying to select stations every time? Bookmark this page!</li>";
	$query = "SELECT *,min((t.hour-f.hour)*60+t.min-f.min) FROM station f 
		join station t on t.line = f.line and t.day = f.day 
		and t.round = f.round and 
		(t.direction = f.direction or t.direction = 0 or f.direction =0)
		and ((t.hour - f.hour) = 1  or (t.hour = f.hour and (t.min - f.min) > 0)) 
		where (f.station = '".stationBack($from,'f')."') and (t.station = '".stationBack($to,'t')."')
		and ((f.day = ".$day." and 
		(f.hour > ".$hour." or (f.hour = ".$hour." and f.min >= ".$min."))) 
		or f.day = ".($day%7+1).") 
		group by f.day, f.line, f.hour, f.min
		order by f.day ".$order.", f.hour, f.min ";
	$results = mysql_query($query);

	//start to print the list schedule
	$counter = 0;
	while($counter<8 && $row = mysql_fetch_array($results)){
		if(!$counter){
			//add to hstory
			addHistory($_GET['from'],$_GET['to']);
			//update the click record first
			updateClick($from);
			updateClick($to);
		}
		printSchedule($row);
		$counter ++;
	}
	//if no result found
	if(!$counter){
		echo "<li>Sorry, no results found, please click the navigation bar to reselect the station</li>";
		//taxi
		/*echo "<li data-theme='a'>Market Place Taxi:585.274.2222</li>";
		echo "<li>   RRL <-> Eastman: $8.00</li>";
		echo "<li>   RRL <-> Market Place Mall: $10.00</li>";
		echo "<li data-theme='a'>Rochester City Taxi Service:585.230.2341</li>";*/
	}

	echo "</ul>";//end print the list schedule

	//if more than 8 results
	if($counter==8){
		echo "<div data-role='collapsible' id='scheduleMore' data-inset='false'>";
		echo "<h3>Click for More</h3>";
		echo "<ul data-role='listview' data-inset='false'>";
		while($counter<40 && $row = mysql_fetch_array($results)){
			printSchedule($row);
			$counter ++;
		}
		echo "</ul></div>";//end of collipse
	}
}

//plus one for the clicked station
function updateClick($station){
	//update all stations
	$updateQuery = "select * from popular where station = '".$station."'";
	$updateResult = mysql_query($updateQuery);
	$updateRow = mysql_fetch_array($updateResult);
	$plusQuery = "update popular set click = ".($updateRow[1]+1)." where station = '".$updateRow[0]."'";
	mysql_query($plusQuery);
	//update single
	$updateQuery = "select * from singleStation where station = '".$station."' and id = '".$_COOKIE['id']."'";
	$updateResult = mysql_query($updateQuery);
	//if it exists
	if($updateRow = mysql_fetch_array($updateResult)){
		$plusQuery = "update singleStation set number = ".($updateRow[2]+1)." where id = '".$updateRow[0]."'and station = '".$updateRow[1]."'";
		mysql_query($plusQuery);
	}
}

//function to print the result
function printSchedule($row){
	//0:line; 1:from; 2:hour; 3:min;
	//7:line; 8:to; 9:hour; 10:min;
	echo "<li style='border-bottom:1px solid ".lineColor($row).";border-left:5px solid ".lineColor($row)."'>";
	//echo "<strong style='color:".lineColor($row)."'>".$row[0]."<strong/></br>";
	echo $row[0];

	echo "<h1 style='font-size:170%'>";
	echo "<span style='font-size:58%'>Leaves @ </span>";
	echo ($row[2]%24).":".minPlus($row[3]);
	echo "</h1>";

	echo "Arrives @ ".($row[9]%24).":".minPlus($row[10]);

	echo "<span class='ui-li-count'>".leftTime($row)." "." </span>";
	echo "</li>";
}

//check how many times left
function leftTime($row){
	//get the current time
	date_default_timezone_set('America/New_York');
	$date = getdate(time());
	$sec = $date['seconds'];
	$min = $date['minutes'];
	$hour = $date['hours'];
	$day = $date['weekday'];

	$wait = 60*($row[2]%24-$hour)+$row[3]-$min;
	//if it is the next day
	if($wait<0)
		$wait += (60*24);
	//discuss different case
	if($wait>60)
		$wait = ">60 min";
	else if($wait==0)
		$wait = "right now!";
	else if($wait==1)
		$wait = "<1 min";
	else
		$wait = $wait." min";
	//what if tomorrow
	if(($row[4]-dayConvert($day)+7)%7==1)
		$wait = "tomorrow";
	//return 
	return $wait;
}

//add the searching item to the database
function addHistory($from,$to){
	//check is id exists
	if(isset($_COOKIE['id'])){
		$hQuery = "SELECT distinct * FROM single where id = ".$_COOKIE['id']." and `from` = '".$from."' and `to` = '".$to."'";
		$hResults = mysql_query($hQuery);
		//if this route exists,update
		if($hRow = mysql_fetch_array($hResults))
			$addQuery = "update single set number = ".($hRow[3]+1)." where id = '".$_COOKIE['id']."' and `from` = '".$from."' and `to` = '".$to."'";
		//if this route not exists, insert
		else
			$addQuery = "insert into single values ('".$_COOKIE['id']."','".$from."','".$to."',1)";

	}
	mysql_query($addQuery);
}

if(!isset($_COOKIE['id'])){
	//create a random COOKIE 
	$rand = rand();
	//set id to COOKIE
	setcookie("id", $rand, time()+3600*24*365*3);
	//add all stations to the list
	$query = "select distinct station from popular order by click desc";
	$results = mysql_query($query);
	//the first one is RRL, set the default number as 10
	$row = mysql_fetch_array($results);
	$addQuery = "insert into singleStation values ('".$rand."','".$row[0]."',10)";
	mysql_query($addQuery);
	//add the rest set the default number as 0
	while($row = mysql_fetch_array($results)){
		$addQuery = "insert into singleStation values ('".$rand."','".$row[0]."',0)";
		mysql_query($addQuery);
	}
}
function fetchRev($to,$from){

	//get the current time
	date_default_timezone_set('America/New_York');
	$date = getdate(time());
	$sec = $date['seconds'];
	$min = $date['minutes'];
	$hour = $date['hours'];
	$day = $date['weekday'];

	//convert day to integer
	//consider the 00:00-4:00 situation
	if($hour<5){
		$day = (dayConvert($day)+5)%7+1;//get the previous day
		$hour += 24;//consider it as 25 hour of the previousday
	}
	else
		$day = dayConvert($day);
	//consider sunday 7 and monday 1 order
	if($day==7)
		$order = "desc";
	else
		$order = "asc";

	//get the information
	echo "<ul data-role='listview' data-dividertheme='c' style = 'display:none' id='scheduleRev'>";
	//prompt for bookmarking
	//echo "<li data-role='list-divider' style='border-bottom:1px solid black;border-left:5px solid black;'>Annoying to select stations every time? Bookmark this page!</li>";
	$query = "SELECT *,min((t.hour-f.hour)*60+t.min-f.min) FROM station f 
		join station t on t.line = f.line and t.day = f.day 
		and t.round = f.round and 
		(t.direction = f.direction or t.direction = 0 or f.direction =0)
		and ((t.hour - f.hour) = 1  or (t.hour = f.hour and (t.min - f.min) > 0)) 
		where (f.station = '".stationBack($from,'f')."') and (t.station = '".stationBack($to,'t')."')
		and ((f.day = ".$day." and 
		(f.hour > ".$hour." or (f.hour = ".$hour." and f.min >= ".$min."))) 
		or f.day = ".($day%7+1).") 
		group by f.day, f.line, f.hour, f.min
		order by f.day ".$order.", f.hour, f.min ";
	$results = mysql_query($query);

	//start to print the list schedule
	$counter = 0;
	while($counter<8 && $row = mysql_fetch_array($results)){
		printSchedule($row);
		$counter ++;
	}
	//if no result found
	if(!$counter){
		echo "<li>Sorry, no results found, please click back buttom to reselect the station</li>";
	}

	echo "</ul>";//end print the list schedule

	//if more than 8 results
	if($counter==8){
		echo "<div data-role='collapsible' style = 'display:none' id='scheduleRevMore' data-inset='false'>";
		echo "<h3>Click for More</h3>";
		echo "<ul data-role='listview' data-inset='false'>";
		while($counter<40 && $row = mysql_fetch_array($results)){
			printSchedule($row);
			$counter ++;
		}
		echo "</ul></div>";//end of collipse
	}
}
?>
