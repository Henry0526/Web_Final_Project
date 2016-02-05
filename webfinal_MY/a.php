<html>
<?php
header("Access-Control-Allow-Origin: *");
$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
$url = $_POST['Kurl'] ;
$xml = file_get_contents($url, false, $context);
$xml = simplexml_load_string($xml); 

if($url == "H_LVR_LAND_A.xml"){
	$name = "買賣";
}
if($url == "H_LVR_LAND_B.xml"){
	$name = "預售屋";
}
if($url == "H_LVR_LAND_C.xml"){
	$name = "租賃";
}
$id= $_POST['ID'];//$id 裡面是我勾選的ID

$message = "";

foreach($id as $CheckedID){
	foreach ($xml->$name as $key)
	{
		$unique = $key->編號;
		$right_address = $key->土地區段位置或建物區門牌;
		if($CheckedID == $unique)
		{
		   $message = $message."/*".$right_address;
	    }
    }
}
?>



<head>
<meta name="viewport" content="initial-scale=1.0">
<meta charset="utf-8">

<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>


</head>
<body>


<div id="map" style="width: 600px; height: 500px"></div>


<form method = "POST" action = "123.html">

<p><input type = "submit" value = "Return"/></p>

</form>


</body>
</html>