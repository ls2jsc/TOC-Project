<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$city = array();
$data = json_decode(file_get_contents('data.json'), true);//test the time without loading data  
foreach($data as $k => $arr)
{
	if(strstr($arr['土地區段位置或建物區門牌'], '新北市'))
	{
		$city['新北市'][$arr['單價每平方公尺']] = $arr['土地區段位置或建物區門牌'];
	}
	else if(strstr($arr['土地區段位置或建物區門牌'], '桃園縣'))
	{
		$city['桃園縣'][$arr['單價每平方公尺']] = $arr['土地區段位置或建物區門牌'];
	}
	else
	{
		if(strstr($arr['土地區段位置或建物區門牌'], '臺中市'))
		{
			$city['臺中市'][$arr['單價每平方公尺']] = $arr['土地區段位置或建物區門牌'];
		}
		else if(strstr($arr['土地區段位置或建物區門牌'], '高雄市'))
		{
			$city['高雄市'][$arr['單價每平方公尺']] = $arr['土地區段位置或建物區門牌'];
		}
		else
		{
			if(strstr($arr['土地區段位置或建物區門牌'], '臺北市'))
			{
				$city['臺北市'][$arr['單價每平方公尺']] = $arr['土地區段位置或建物區門牌'];
			}
			else if(strstr($arr['土地區段位置或建物區門牌'], '臺南市'))
			{
				$city['臺南市'][$arr['單價每平方公尺']] = $arr['土地區段位置或建物區門牌'];
			}
			else
			{
				if(strstr($arr['土地區段位置或建物區門牌'], '新竹縣'))
				{
					$city['新竹縣'][$arr['單價每平方公尺']] = $arr['土地區段位置或建物區門牌'];
				}
				else if(strstr($arr['土地區段位置或建物區門牌'], '嘉義縣'))
				{
					$city['嘉義縣'][$arr['單價每平方公尺']] = $arr['土地區段位置或建物區門牌'];
				}
				else;
			}
		}
	}
}
foreach($city as $key => $array)
{
	krsort($array);
	echo $key.' : ';
	echo '<br>'.current($array);//陣列指標, current印出現在位置, next移動指標並向下移動
	echo '<br>'.next($array);
	echo '<br>'.next($array);
	echo '<br>'.next($array);
	echo '<br>'.next($array).'<br><br>';
}
//原先預定藉由google的distance API去自動算出所需行車時間, 但因準確度不高故放棄
//$json = file_get_contents('http://maps.googleapis.com/maps/api/distancematrix/json?origins=新北市板橋區民族路&destinations=板橋高鐵站&language=zh-TW&sensor=false');
//$result = json_decode($json, true); // convert it from JSON to php array
//echo $result['rows'][0]['elements'][0]['duration']['text'];
?>