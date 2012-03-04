<script type="text/javascript">
$(document).ready(function(){
	<?php include("mobile.php");?>
	<?php include("textAnimation.php");?>
	//if desktop,add like button
	if(!jQuery.browser.mobile){
		//facebook like buttom
		$("#schedule li:nth-child(1)").html($("#schedule li:nth-child(1)").html()+ " <div class='fb-like' data-href='http://facebook.com/urshuttle' data-send='false' data-layout='button_count' data-width='450' data-show-faces='false'></div>");
		$("#scheduleRev li:nth-child(1)").html($("#scheduleRev li:nth-child(1)").html()+ " <div class='fb-like' data-href='http://facebook.com/urshuttle' data-send='false' data-layout='button_count' data-width='450' data-show-faces='false'></div>");
		//R to reverse(since jquery not loading this time, so no need to go to span)
		$('#reverse').html('Reverse');
	}
	//when a station is choosen
	$(".station").click(function(){
		//the origin decided
		if($("#fromStation").attr("class").match(/active/)){
			//fill in the station name
			$("#fromStation span span:nth-child(1)").html("From:"+$(this).html());
			$("#fromStation").attr("station",$(this).html());
			//switch the active column switch class
			switchHighlight();	
			//change icon to check
			changeIcon("fromStation",true);
			//claer the search
			clearSearch();
			//animation
				$("#fromStation span span:nth-child(1)").textAnimation({  
					mode:"highlight",highlightColor:"#00FFFF",baseColor:"#ffff00"
				});  
		}
		//the destination decides,call the ajax to show up the schedule
		else if($("#toStation").attr("class").match(/active/)){
			//change the content in the navbar
			$("#toStation span span:nth-child(1)").html("To:"+$(this).html());
			$("#toStation").attr("station",$(this).html());
			//change icon to check
			changeIcon("toStation",true);
			//highlight check
			$("#check").attr("class","ui-btn-right ui-btn ui-btn-icon-right ui-btn-corner-all ui-shadow ui-btn-up-e");
			$("#check").attr("data-theme","e");
			//claer the search
			clearSearch();
			//animation
				$("#toStation span span:nth-child(1)").textAnimation({  
					mode:"highlight",baseColor:"white",highlightColor:"#2fff5f",
				});  
			//desktop version 2 clicks
			if(!jQuery.browser.mobile){
				//hide the station list and the search box
				$("#stationFieldset").fadeOut();
				//reload to the schedule page
				getResult(false);//false:not reverse
			}
		}
	});

	//when the from column/clear/back is clicked
	$("#fromStation").click(function(){restart2();});
	$("#clear").click(function(){restart2();});
	//when the to column is clicked
	$("#toStation").click(function(){restart();});


	//function for button clear,back,and fromStation to recover the original status
	//just add a recover from code
	function restart2(){
		//prevent it not active by itself and deactivate the to bar
		$("#fromStation").attr("class","ui-btn ui-btn-icon-top ui-btn-active ui-btn-up-a");
		$("#toStation").attr("class","ui-btn ui-btn-icon-top ui-btn-up-a");
		//change it back to "from?" also change back the icon
		$("#fromStation span span:nth-child(1)").html("From?");
		$("#fromStation").attr("station","From?");
		changeIcon("fromStation",false);
		restart();
	}
	//restart:recover almost everything
	function restart(){
		//clear the schedule
		$("#schedule").hide(); $("#scheduleMore").hide();
		//and set the other bar to 50% width
		$("#reverse").parent().siblings().css('width','50%');
		//remove the reverse button
		$("#reverse").parent().hide();
		//get back the station list
		$("#stationFieldset").show();
		//change it back to "to?" also change back the icon
		$("#toStation span span:nth-child(1)").html("To?");
		$("#toStation").attr("station","To?");
		changeIcon("toStation",false);
		//change the the refresh button to check button
		$("#check span span:nth-child(1)").html("CHECK");
		$("#check span span:nth-child(2)").attr("class","ui-icon ui-icon-arrow-r ui-icon-shadow");
		$("#check").attr("data-theme","a");
		$("#check").attr("data-icon","arrow-r");
		//change the back buttom to clear all button and the icon
		$("#clear span span:nth-child(1)").html("Clear All");
		$("#clear span span:nth-child(2)").attr("class","ui-icon ui-icon-delete ui-icon-shadow");
		//claer the search
		clearSearch();
	}

	//when click the check button on the top right corner
	$("#check").click(function(){
		getResult(false);//false means not reverse
	});
	//function to switch the station name
	function switchStation(){
		var from = $("#fromStation").attr("station");
		var to = $("#toStation").attr("station");
		$("#fromStation span span:nth-child(1)").html(to);
		$("#toStation span span:nth-child(1)").html(from);
		$("#fromStation").attr("station",to);
		$("#toStation").attr("station",from);
	}
	//when click the reverse button in the middle 
	$("#reverse").click(function(){
		if($('#schedule').css('display')=='none'){
			$('#schedule').show(); $('#scheduleMore').show();
			$('#scheduleRev').hide(); $('#scheduleRevMore').hide();
			switchStation();
			//cancel highlight
			$(this).css('background','#333'); $(this).css('color','#ddd');
		}
		else{
			$('#schedule').hide(); $('#scheduleMore').hide();
			$('#scheduleRev').show(); $('#scheduleRevMore').show();
			switchStation();
			//highlight
			$(this).css('background','#4596CE'); $(this).css('color','#ffe87c');
			}
	});
	//when the enter buttom is pressed
	//$("body").keypress(function(event){
	//	if ( event.which == 13 ) {
	//	}
	//});

	///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////

	//change the navbar icon if the station selected
	function changeIcon(id,checked){
		if(checked){
			$("#"+id).attr('data-icon','check');
			$("#"+id+" span span:nth-child(2)").attr("class","ui-icon ui-icon-check ui-icon-shadow");
			$("#"+id+" span span:nth-child(1)").css("color","#FFBA36");
		}
		else{
			$("#"+id).attr('data-icon','search');
			$("#"+id+" span span:nth-child(2)").attr("class","ui-icon ui-icon-search ui-icon-shadow");
			$("#"+id+" span span:nth-child(1)").css("color","white");
		}
	}

	//switch the highlight column
	function switchHighlight(){
			var from = $("#fromStation").attr('class');
			var to = $("#toStation").attr('class');
			$("#fromStation").attr('class',to);
			$("#toStation").attr('class',from);
	}

	//clear the search box and get back the filtered list
	function clearSearch(){
			//clear the search form
			$("#content form div input").val("");
			//get back all stations
			$(".stationLi").attr("class",'stationLi ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c');
			//scroll to the top
			$("body").scrollTop(0);
	}

	//relocate to the schedule result page
	function getResult(reverse){
			//fetch information
			var from =$("#fromStation").attr('station'); var to =$("#toStation").attr('station');
			//check if confilct
			if(from==to){
				alert("you are choosing the same places");
				//change the content in the navbar
				$("#toStation span span:nth-child(1)").html("To?");
				//change the station attribule
				$('#toStation').attr('station','To?');
				//change icon to check
				changeIcon("toStation",false);
				$("#stationFieldset").fadeIn();
			}
			else if(from=="From?"){
				//dont alert if desktop version
				if(jQuery.browser.mobile)
					alert("please choose the origin"); 
				switchHighlight();
				$("#stationFieldset").fadeIn();
			}
			else if(to=="To?"){
				alert("please choose the destination"); $("#stationFieldset").fadeIn();
			}
			else{
				if(reverse)
					document.location.replace("index.php?from="+to+"&to="+from);//redirect
				else
					document.location.replace("index.php?from="+from+"&to="+to);//redirect
			}
	}
	//history click
	$(".history").click(function(){
		//hide the station list and the search box
		$("#stationFieldset").hide();
		document.location.replace("index.php?from="+$(this).attr('from')+"&to="+$(this).attr('to')+"&shortcut=true");//redirect
	});
});
</script>
