<?php
header("Content-Type:text/html; charset=utf-8");
$Area = $_POST['Area'];
$Kind = $_POST['Kind'];
$Range = $_POST['Range'];

header("Access-Control-Allow-Origin: *");
$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
switch($Kind)
{	
	case "買賣":
	$url = "H_LVR_LAND_A.xml" ;
	$tag = "買賣";
	break;
	case "預售屋":
	$url = "H_LVR_LAND_B.xml" ;
	$tag = "預售屋";
	break;
	case "租賃":
	$url = "H_LVR_LAND_C.xml" ;
	$tag = "租賃";
	break;
}
switch($Range)
{	
	case "10000":
	$below = 10;
	$upper = 50000;
	break;
	case "100000":
	$below = 50001;
	$upper = 100000;
	break;
	case "1000000":
	$below = 100001;
	$upper = 1000000;
	break;
}
$ID;
$xml = file_get_contents($url, false, $context);
$xml = simplexml_load_string($xml);
$a = "addr";
print("<form onclick ='show_map(this,". '"' .$a . '"' . ");'>");
print ("<table><tr><td>\</td><td>地區</td><td>編號</td><td>地址</td><td>價錢</td></tr>");
foreach ($xml-> $tag as $key)
{
    $area = $key -> 鄉鎮市區;
    $ID = $key -> 編號;
	$address = $key -> 土地區段位置或建物區門牌;
	$price = $key -> 單價每平方公尺;
    if($area == $Area && $price >=$below && $price <= $upper)
	{
		print ("<tr><td>". '<input type="checkbox" name="addr" value="'.$address.'"> ' 
		."</td><td>" . $area . "</td><td>" . $ID . "</td><td>" . $address . "</td><td>" . $price .  "</td></tr>");
		//印出checkbox和每一筆符合條件的資料
	}
}
print ("</table>");
print('</form>');


?>