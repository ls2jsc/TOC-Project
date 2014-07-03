<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$target = $_POST['target'];
$city = array();
$data = json_decode(file_get_contents('data.json'), true);
foreach($data as $key => $arr)
{
	if(strstr($arr['土地區段位置或建物區門牌'], $target))//統計資料
	{
		$temp = $arr['鄉鎮市區'];
		$city[$temp]['total'] += $arr['總價元'];
		$city[$temp]['count'] += 1;
		if($city[$temp]['min'] == null)
		{
			$city[$temp]['min'] = $arr['總價元'];
			$city[$temp]['min_time'] = $arr['交易年月'];
			$city[$temp]['min_m2'] = $arr['土地移轉總面積平方公尺']+$arr['建物移轉總面積平方公尺']+$arr['車位移轉總面積平方公尺'];
			$city[$temp]['min_content'] = $arr['交易筆棟數'];
		}
		if($arr['總價元'] > $city[$temp]['max'] )
		{
			$city[$temp]['max'] = $arr['總價元'];
			$city[$temp]['max_time'] = $arr['交易年月'];
			$city[$temp]['max_m2'] = $arr['土地移轉總面積平方公尺']+$arr['建物移轉總面積平方公尺']+$arr['車位移轉總面積平方公尺'];
			$city[$temp]['max_content'] = $arr['交易筆棟數'];
		}
		else if($arr['總價元'] < $city[$temp]['min'])
		{
			$city[$temp]['min'] = $arr['總價元'];
			$city[$temp]['min_time'] = $arr['交易年月'];
			$city[$temp]['min_m2'] = $arr['土地移轉總面積平方公尺']+$arr['建物移轉總面積平方公尺']+$arr['車位移轉總面積平方公尺'];
			$city[$temp]['min_content'] = $arr['交易筆棟數'];
		}
		else;
		if(strstr($arr['交易標的'], '車位'))
		{
			$city[$temp]['park'] += 1;
		}
		if(strcmp($arr['有無管理組織'], '有') == 0)
		{
			$city[$temp]['manage'] += 1;
		}
	}
}
echo '< '.$target.' > 各區交易分析 : <br>';
foreach($city as $section => $array)
{
	echo '<br><br>'.$section.' :';
	echo '<br>交易總數量 : '.$array['count'];
	if($array['park'] != null)//如果有才顯示
	{
		echo '  含有車位數量 : '.$array['park'];
	}
	if($array['manage'] != null)
	{
		echo '  含有管理組織數量 : '.$array['manage'];
	}
	echo '<br>平均成交價格 : '.intval($array['total']/$array['count']).'元';
	$area = sprintf("%.2f",$array['max_m2']*0.3025);//一平方公尺 = 0.3025坪
	echo '<br>最高成交價 : '.$array['max'].'元  時間 : '.$array['max_time'].'  總交易面積 : '.$area.'坪 (每坪'.intval($array['max']/$area).'元) 交易項目 : '.$array['max_content'];
	if($array['count'] != 1)
	{
		$area = sprintf("%.2f",$array['min_m2']*0.3025);
		echo '<br>最低成交價 : '.$array['min'].'元  時間 : '.$array['min_time'].'  總交易面積 : '.$area.'坪 (每坪'.intval($array['min']/$area).'元) 交易項目 : '.$array['min_content'];
	}
}
?>