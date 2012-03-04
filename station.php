<?php
function stationConvert($simple){
	switch ($simple){
		case "RRL": return "RRL";break;
		case "PL": return "Park Lot";break;
		case "HEB": return "Hpm Eng Bldg.";break;
		case "Towers": return "Towers";break;
		case "W&M": return "Wilson & McLean";break;
		case "G&S": return "Gregory & South";break;
		case "S&A": return "South & Alex";break;
		case "M&A": return "Monroe & Alex";break;
		case "P&C": return "Park & Culver";break;
		case "P&B(GEH)": return "Park & Brgtn(GEH)";break;

		case "P&A": return "Park & Alex";break;
		case "U&A(MAG)": return "Univ & Alex(MAG)";break;
		case "ELC": return "Eastman";break;
		case "MH&M": return "Mt.Hope & McLean";break;
		case "C/WH": return "Crtndn/W Henrietta";break;
		case "M10": return "Movies 10";break;
		case "MM": return "Marketplace";break;
		case "Wegmans": return "Wegmans";break;
		case "Target": return "Target";break;
		case "W-M": return "Wal-Mart";break;

		case "R-H": return "Regal Henrietta";break;
		case "S/UP": return "Southside/Univ Park";break;
		case "Eastman": return "Eastman";break;
		case "WP": return "Whipple";break;
		//case "PM": return "Public Market";break;
		case "Wilmot": return "Wilmot";break;
		case "MHE": return "Mt.Hope & Elmwd";break;
		case "TP": return "Tops Plaza";break;
		case "TC": return "Twelve Corners";break;
		case "CL": return "Clover Lns";break;

		case "PP": return "Ptsford Plaza";break;
		case "R/BL": return "Riverview/Brooks";break;
		case "B&B": return "Brooks & Buell";break;
		case "GS@GPB": return "Genes St.@GenesParkBlvd.";break;
		case "GS@WS": return "Genes St.@WeldonSt.";break;
		case "GS@SA": return "Genes St.@SpruceAve.";break;
		case "GS@CA": return "Genes St.@CongressAve.";break;
		case "GS@TP": return "Genes St.@TerracePk.";break;
		case "BS@GS": return "Barton St.@GenesSt.";break;
		case "RA": return "Riverview Apts";break;

		case "BA@GS/PA": return "Brks Ave.@GenesSt/PlymAve.";break;
		case "BA@MS/PS": return "Brks Ave.@MlbkSt/PaigeSt.";break;
		case "BA@KS": return "Brks Ave.@KronSt.";break;
		case "BA@ES": return "Brks Ave.@EvglnSt.";break;
		case "PS@BA": return "Pioneer St.@Brks Ave.";break;
		case "PS@TP": return "Pioneer St.@TerracePk.St.";break;
		case "PS@CA": return "Pioneer St.@CgrsAve.";break;
		case "PS@SA": return "Pioneer St.@SpruceAve.";break;
		case "PS@WS": return "Pioneer St.@WeldonSt.";break;
		case "GPB@PS": return "GenesParkBlvd.@PioneerSt.";break;

		case "ID/GH": return "IntCampus Dr/Ggn Hall";break;
		case "BL": return "Brooks Landing";break;
		case "LL": return "Laser Lab";break;
		case "K&C": return "Kendrick & Critndn";break;
		case "TH": return "Towne House";break;
		case "G&E": return "Goler & East";break;
		case "HWH": return "Helen Wood Hall";break;
		default:return "*";
	}
}

function stationBack($complex,$ft){
	switch ($complex){
		case "RRL/Rush Rhees Library": return "RRL";break;
		//case "Park Lot": return "PL";break;
		case "Hopeman Engineering Bldg.": return "HEB";break;
		case "Towers": return "Towers";break;
		case "Wilson and McLean": return "W&M";break;
		case "Gregory and South": return "G&S";break;
		case "South and Alexander": return "S&A";break;
		case "Monroe and Alexander": return "M&A";break;
		case "Park and Culver": return "P&C";break;
		case "Park and Barrington(GEH)": return "P&B(GEH)";break;

		case "Park and Alexander": return "P&A";break;
		case "University and Alexander(MAG)": return "U&A(MAG)";break;
		//case "Eastman Living Center": return "ELC";break;
		case "Mt. Hope and McLean": return "MH&M";break;
		case "Crittenden/West Henrietta": return "C/WH";break;
		case "Movies 10": return "M10";break;
		case "Marketplace Mall": return "MM";break;
		case "Wegmans": return "Wegmans";break;
		case "Target": return "Target";break;
		case "Wal-Mart": return "W-M";break;

		case "Regal Henrietta": return "R-H";break;
		case "Southside,Park Lot,University Park": return "S/UP' or ".$ft.".station = 'PL";break;
		case "Eastman,Eastman Living Center": return "Eastman' or ".$ft.".station = 'ELC";break;
		case "Whipple Park": return "WP";break;
		case "Whipple Park(Green Line)": return "WP(G)";break;
		case "Public Market": return "PM";break;
		case "Wilmot": return "Wilmot";break;
		case "Mt. Hope and Elmwood": return "MHE";break;
		case "Tops Plaza": return "TP";break;
		case "Twelve Corners": return "TC";break;
		case "Clover Lanes": return "CL";break;

		case "Pittsford Plaza": return "PP";break;
		//combine riverview and r/bl for green line
		case "Riverview,Riverview/Brooks Landing": return "R/BL' or ".$ft.".station = 'RA";break;
		case "Brooks and Buell": return "B&B";break;
		case "Genesee St.@Genesee Park Blvd.": return "GS@GPB";break;
		case "Genesee St.@Weldon St.": return "GS@WS";break;
		case "Genesee St.@Spruce Ave.": return "GS@SA";break;
		case "Genesee St.@Congress Ave.": return "GS@CA";break;
		case "Genesee St.@Terrace Pk.": return "GS@TP";break;
		case "Barton St.@Genesee St.": return "BS@GS";break;
		//case "Riverview Apartments": return "RA";break;

		case "Brooks Ave.@Genesee St./Plymouth Ave.": return "BA@GS/PA";break;
		case "Brooks Ave.@Millbank St./Paige St.": return "BA@MS/PS";break;
		case "Brooks Ave.@Kron St.": return "BA@KS";break;
		case "Brooks Ave.@Evangeline St.": return "BA@ES";break;
		case "Pioneer St.@ Brooks Ave.": return "PS@BA";break;
		case "Pioneer St.@Terrace Pk. St.": return "PS@TP";break;
		case "Pioneer St.@Congress Ave.": return "PS@CA";break;
	       	case "Pioneer St.@Spruce Ave.": return "PS@SA";break;
		case "Pioneer St.@Weldon St.": return "PS@WS";break;
		case "Genesee Park Blvd.@Pioneer St.": return "GPB@PS";break;

		case "Intercampus Drive/Goergen Hall": return "ID/GH";break;
		case "Brooks Landing": return "BL";break;
		case "Laser Lab": return "LL";break;
		case "Kendrick and Crittenden": return "K&C";break;
		case "Towne House": return "TH";break;
		case "Goler and East": return "G&E";break;
		case "Helen Wood Hall": return "HWH";break;
		default : return "";
	}
}

//convert day from string to int(1-7)
function dayConvert($day){
	switch ($day){
		case "Monday": return 1;
		case "Tuesday": return 2;
		case "Wednesday": return 3;
		case "Thursday": return 4;
		case "Friday": return 5;
		case "Saturday": return 6;
		case "Sunday": return 7;
	}
}

//change the min to two digits
function minPlus($num){
	switch ($num){
		case 0: return "00";break;
		case 1: return "01";break;
		case 2: return "02";break;
		case 3: return "03";break;
		case 4: return "04";break;
		case 5: return "05";break;
		case 6: return "06";break;
		case 7: return "07";break;
		case 8: return "08";break;
		case 9: return "09";break;
		default: return $num;
	}
}
//decide the color of the result
function lineColor($row){
	$name = $row[0];
	if(strpos($name,"Green")!==false)
		return "#347C17";
	else if(strpos($name,"Red")!==false)
		return "#C11B17";
	else if(strpos($name,"Silver")!==false)
		return "#463E41";
	else if(strpos($name,"Gold")!==false)
		return "#D4A017";
	else if(strpos($name,"Blue")!==false)
		return "#1569C7";
	else
		return "";
}
?>
