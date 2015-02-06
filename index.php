<html>
<title>Monthly Menu Selector - Chrisj</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<?php

# Connect to database
connectDB();
$tm=time();
$ref=$_SERVER['HTTP_REFERER'];
$agent=$_SERVER['HTTP_USER_AGENT'];
$ip=$_SERVER['REMOTE_ADDR'];
$site = 'www.chrisj.co.uk/menu'; 
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$tracking_page_name = $_SERVER['HTTP_REFERER'];

$strSQL = "INSERT INTO track(tm, site, time, ref, agent, ip, tracking_page_name, hostname) VALUES ('$tm','$site',now(),'$ref','$agent','$ip','$tracking_page_name', '$hostname')";
$test=mysql_query($strSQL);

global $components;
print "<table><tr><td><form action=index.php method=post>
<select name=month>
<option value='January,1,2015'>January</option>
<option value='February,2,2015'>February</option>
<option value='March,3,2015'>March</option>
<option value='April,4,2015'>April</option>
<option value='May,5,2015'>May</option>
<option value='June,6,2015'>June</option>
<option value='July,7,2015'>July</option>
<option value='August,8,2015'>August</option>
<option value='September,9,2015'>September</option>
<option value='October,10,2015'>October</option>
<option value='November,11,2015'>November</option>
<option value='December,12,2015'>December</option>
</select></td>";


#if (isset($_REQUEST['component'])) {
#global $selections;
#$selections = '"';
#$selections .= implode('", "',$_REQUEST['component']);
#$selections .= '"';
#}

#$qq = 'select distinct(mainComponent) from meals where mainComponent != "Naughty"';
#$res = mysql_query($qq) or die ("Cannot run SQL query: $qq");
#while ($row = mysql_fetch_array($res)) {
#$str = '/' . $row['mainComponent'] . '/';
#if (preg_match($str, $selections) || (!$_REQUEST['component'])) {
#$check = " CHECKED";
#} else {
#$check = '';
#}

#print '<td><input type="checkbox" name="component[]" value="' . $row['mainComponent'] . '"' . $check . '>' . #$row['mainComponent'] . "</td>";
#}
print '</tr><tr><td><input type="submit" value="Get Menu!"></td></tr>';
print "</table>";

if (isset($_REQUEST['month'])) {
$parts = explode(",",$_REQUEST['month']);
echo '<h1>'.$parts[0].' 2015</h1>';
echo draw_calendar($parts[1],$parts[2]);
echo '<p id="legal"> Designed by <a href="www.chrisj.co.uk">chrisj.co.uk &copy </a></p>';

#print '<h2>Summary</h2><ul>';
#arsort($components);
#foreach ($components as $component => $val) {
#print "<li>$component - $val</li>";
#}
#print "</ul>";
}

/* draws a calendar */
function draw_calendar($month,$year){
global $mealsArray;
#global $selections;

$mealsArray = array();

# Read off all entries
#if ($selections) {
#$qq = "select * from meals where mainComponent in (" . $selections . ") order by day";
#} else {
$qq = "select * from meals order by day";
#}
$result = mysql_query($qq) or die ("Cannot run SQL query: $qq");
$num = mysql_num_rows($result);
#print "Recipes found: <b>$num</b><hr>";
while($row=mysql_fetch_assoc($result)) {array_push($mealsArray, $row);} 
shuffle($mealsArray);
#print_r($mealsArray);
#exit();

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			$str = '';

			$str =  findDayMeal($running_day + 1);

		    $calendar.= str_repeat('<p>' . $str . '</p>',1);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}


function findDayMeal($dayNum) {
global $mealsArray;
global $components;

if (!preg_match("/^1$|^6$|^7$/",$dayNum)) {
## WeekDay
$found = '0';
while ($found == '0') {
  $mealSelection = array($key = array_rand($mealsArray), $mealsArray[$key]);
  if (($mealSelection[1]['day']) || (!$mealSelection[1]['description']) ) {
    $mealSelection = array($key = array_rand($mealsArray), $mealsArray[$key]);
    } else {
    $found = '1';
	}	
}
unset($mealsArray[$key]);
# Check for book and page
$str = "<b>" . $mealSelection[1]['description'] . "</b><br><center>";
#if ($mealSelection[1]['image']) {
#$str .= "<br><center><img border=0 src='" . $mealSelection[1]['image'] . "'>";
#}
$str .= putImages($mealSelection[1]['description']);

$str .= "</center>";


if ($mealSelection[1]['recipeBook']) {
  $str .= "<br>" . $mealSelection[1]['recipeBook'] . "";
  if ($mealSelection[1]['page']) {
  $str .= "<i> (page " . $mealSelection[1]['page'] . ")</i>";
  }
}


$components[$mealSelection[1]['mainComponent']]++;
return $str;
} else {
## Weekend
$found = 0;
$mealSelection = array($nkey = array_rand($mealsArray), $mealsArray[$nkey]);
while ($found < 1) {
if ($mealSelection[1]['day'] == $dayNum)  {
      $found++;
#	  print " - Found $dayNum (" . $mealSelection[1]['description'] . ") <br> ";
	  } else {
	  $mealSelection = array($nkey = array_rand($mealsArray), $mealsArray[$nkey]);
	  }	
  }

unset($mealsArray[$nkey]);
$components[$mealSelection[1]['mainComponent']]++;
# Check for book and page
$str = "<b>" . $mealSelection[1]['description'] . "</b><br><center>";
if ($mealSelection[1]['image']) {
$str .= "<br><center><img border=0 src='" . $mealSelection[1]['image'] . "'>";
}
$str .= putImages($mealSelection[1]['description']);

$str .= "</center>";
#$str .= "<br><center><img border=0 src='" . $mealSelection[1]['image'] . "'></center>";

if ($mealSelection[1]['recipeBook']) {
  $str .= "<br>" . $mealSelection[1]['recipeBook'];
  if ($mealSelection[1]['page']) {
  $str .= "<i> (page " . $mealSelection[1]['page'] . ")</i>";
  }
}


return $str;
}

}

function putImages($desc) {
$str = '';

if (preg_match('/chips/i',$desc)) {
 $str .= "<img src=images/chips.jpg>";
}

if (preg_match('/sausage|banger|bacon|gammon|ham|chorizo|splonk|pork/i',$desc)) {
 $str .= "<img src=images/pig.png>";
}

if (preg_match('/fish/i',$desc)) {
 $str .= "<img src=images/fish.jpg>";
}

if (preg_match('/prawn/i',$desc)) {
 $str .= "<img src=images/prawn.gif>";
}
if (preg_match('/halloumi|camenbert|cheese/i',$desc)) {
 $str .= "<img src=images/cheese.gif>";
}
if (preg_match('/lamb/i',$desc)) {
 $str .= "<img src=images/sheep.jpg>";
}
if (preg_match('/roast|casserole/i',$desc)) {
 $str .= "<img src=images/roast.gif>";
}
if (preg_match('/chicken/i',$desc)) {
 $str .= "<img src=images/chicken.gif>";
}
if (preg_match('/mash|wedge|cottage|spud|potato/i',$desc)) {
 $str .= "<img src=images/potato.jpg>";
}

if (preg_match('/greek|stifado|souvlakia|moussaka/i',$desc)) {
 $str .= "<img src=images/greek.jpg>";
}


if (preg_match('/teriyaki/i',$desc)) {
 $str .= "<img src=images/japan.gif>";
}

if (preg_match('/malay/i',$desc)) {
 $str .= "<img src=images/maylasia.gif>";
}


if (preg_match('/tortilla/i',$desc)) {
 $str .= "<img src=images/mexico.gif>";
}

if (preg_match('/brocolli|broccoli/i',$desc)) {
 $str .= "<img src=images/brocolli.jpg>";
}

if (preg_match('/mushroom/i',$desc)) {
 $str .= "<img src=images/mushroom.jpg>";
}

if (preg_match('/stilton/i',$desc)) {
 $str .= "<img src=images/blueCheese.jpg>";
}

if (preg_match('/vegetarian/i',$desc)) {
 $str .= "<img src=images/vegetarian.gif>";
}
if (preg_match('/spinach/i',$desc)) {
 $str .= "<img src=images/spinach.png>";
}

if (preg_match('/stir fry/i',$desc)) {
 $str .= "<img src=images/wok.jpg>";
}

if (preg_match('/beef|burgers|Beouf|meatballs|steak|cottage pie/i',$desc)) {
$str .= "<img src=images/cow.png>";
}

if (preg_match('/omlette|egg/i',$desc)) {
 $str .= "<img src=images/egg.jpg>";
}

if (preg_match('/pepper/i',$desc)) {
 $str .= "<img src=images/pepper.jpg>";
}

if (preg_match('/garlic/i',$desc)) {
 $str .= "<img src=images/garlic.jpg>";
}
if (preg_match('/taco/i',$desc)) {
 $str .= "<img src=images/taco.jpg>";
}
if (preg_match('/chilli/i',$desc)) {
 $str .= "<img src=images/chilli.jpg>";
}
if (preg_match('/thai/i',$desc)) {
 $str .= "<img src=images/thai.gif>";
}

if (preg_match('/pasta|carbona|penne|spaghetti|arrabiat/i',$desc)) {
 $str .= "<img src=images/pasta.jpg>";
}

return $str;
}

function connectDB()
{
$db = mysql_connect('localhost', 'root', 'qwas1234');
if (!$db) {
  return 1;
 }

if (!@mysql_select_db('menu', $db)) {
  return 2;
 }
}

?>
