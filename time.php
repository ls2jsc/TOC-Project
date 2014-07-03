<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$city = array();
$data = json_decode(file_get_contents('data.json'), true);//test the time without loading data  
foreach($data as $key => $arr)
{
	if(strstr($arr['土地區段位置或建物區門牌'], '縣')||strstr($arr['土地區段位置或建物區門牌'], '市'))
	{
		$temp = substr($arr['土地區段位置或建物區門牌'], 0, 9);
		$city[$temp]['total'] += 1;
		$city[$temp][$arr['交易年月']] += 1;
	}
}
arsort($city);
foreach($city as $key => $array)
{
	if($array['total'] > 10)
	{
		arsort($array);
		echo $key.'<br>';
		print_r($array);
		echo '<br>';
	}
}
//$url = 'http://maps.googleapis.com/maps/api/distancematrix/json?origins=台南火車站&destinations=701台南市中華東路&language=zh-TW&sensor=false';

//$result = json_decode($json, true); // convert it from JSON to php array
//echo $result['rows'][0]['elements'][0]['duration']['text'];
//print_r($result);

?>