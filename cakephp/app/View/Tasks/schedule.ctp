<?php
 
	// 初期値
	$y = date('Y');
	$m = date('n');
		
	// 日付の指定がある場合
	if(isset($_GET['date']) && $_GET['date'] != ''){
		$arr_date = explode('-', htmlspecialchars($_GET['date'], ENT_QUOTES));
		
		if(count($arr_date) == 2 and is_numeric($arr_date[0]) and is_numeric($arr_date[1]))
		{
			$y = (int)$arr_date[0];
			$m = (int)$arr_date[1];
		}
	}
 
	// 祝日の取得の関数
	function japan_holiday($y = '')
	{
	    // カレンダーID
	    $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');
	
	    // 取得期間
	    $start  = date("$y-01-01\T00:00:00\Z");
	    $end = date("$y-12-31\T00:00:00\Z");
	
	    $url = "https://www.google.com/calendar/feeds/{$calendar_id}/public/basic?start-min={$start}&start-max={$end}&max-results=30&alt=json";
	
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
	    $result = curl_exec($ch);
	    curl_close($ch);
	
	    if (!empty($result)) {
	        $json = json_decode($result, true);
	        if (!empty($json['feed']['entry'])) {
	            $datas = array();
	            foreach ($json['feed']['entry'] as $val) {
	                $date = preg_replace('#\A.*?(2\d{7})[^/]*\z#i', '$1', $val['id']['$t']);
	                $datas[$date] = array(
	                    'date' => preg_replace('/\A(\d{4})(\d{2})(\d{2})/', '$1/$2/$3', $date),
	                    'title' => $val['title']['$t'],
	                );
	            }
	            ksort($datas);
	            return $datas;
	        }
	    }
	}
	
	// 祝日取得
	$national_holiday = japan_holiday($y);
?>

<div class="container">

<div class="task-schedule">

<?php echo $this->Html->link('一覧へ戻る', array('controller' => 'groups', 'action' =>'index')); ?>

<table>
	<tr>
		<td><a href="?date=<?php echo h(date('Y-m', strtotime($y .'-' . $m . ' -1 month'))); ?>">&lt; 前の月</a></td>
		<td><?php echo h($y) ?>年<?php echo h($m) ?>月</td>
		<td><a href="?date=<?php echo h(date('Y-m', strtotime($y .'-' . $m . ' +1 month'))); ?>">次の月 &gt;</a></td>
	</tr>
</table>
 
<table style="table-layout:fixed;">
<tr>
	<th>日</th>
	<th>月</th>
	<th>火</th>
	<th>水</th>
	<th>木</th>
	<th>金</th>
	<th>土</th>
</tr>
<tr>
 
<?php
 
	// 1日の曜日を取得
	$wd1 = date("w", mktime(0, 0, 0, $m, 1, $y));
	
	// その数だけ空のセルを作成
	for ($i = 1; $i <= $wd1; $i++) {
		echo "<td> </td>";
	}
	 
	$d = 1;


	while (checkdate($m, $d, $y)) {		

		// 日付出力（土日祝には色付け）
		if(date("w", mktime(0, 0, 0, $m, $d, $y)) == 0)
		{
			echo "<td style='color:red;'>".h($d)."<br>";
		}
		elseif(date("w", mktime(0, 0, 0, $m, $d, $y)) == 6)
		{
			echo "<td style='color:blue;'>".h($d)."<br>";
		}
		elseif(!empty($national_holiday[date("Ymd", mktime(0, 0, 0, $m, $d, $y))]))  
		{
			echo "<td style='color:red;'>".h($d)."<br>";
		}
		else
		{
			echo "<td>".h($d)."<br>";
		}
		

		//その日が期限のタスクのタイトルを表示
		foreach ($auth_tasks as $auth_task):
			$today = $y . '-'. $m . '-' . $d;
			$target_day = $auth_task['Task']['deadline_date'];
			if (strtotime($today) === strtotime($target_day)) {
				// 下書きだった場合
				if ($auth_task['Task']['status'] === '0') {
					if ($auth_task['Task']['user_id'] === $userSession['id']) {
						echo "<ul><li>" . $this->Html->link($auth_task['Task']['title'], array('controller' => 'tasks', 'action' => 'view', $auth_task['Group']['id'], $auth_task['Task']['id'])) . "</li></ul>";
					}
				elseif (isset($auth_task['Task']['title'])) {
					continue;
				}
				// 下書き以外
				} else {
					echo "<ul><li>" . $this->Html->link($auth_task['Task']['title'], array('controller' => 'tasks', 'action' => 'view', $auth_task['Group']['id'], $auth_task['Task']['id'])) . "</li></ul>";
				}
			}
			endforeach;

			echo "</td>";


		// 週の始まりと終わりでタグを出力
		if (date("w", mktime(0, 0, 0, $m, $d, $y)) == 6)
		{
		    // 週を終了
		    echo "</tr>";
			
			// 次の週がある場合は新たな行を準備
		    if (checkdate($m, $d + 1, $y)) {
		        echo "<tr>";
		    }
		}
		

	    $d++;


	}
	
	// 最後の週の土曜日まで空のセルを作成
	$wdx = date("w", mktime(0, 0, 0, $m + 1, 0, $y));
	
	for ($i = 1; $i < 7 - $wdx; $i++)
	{
		echo "<td>　</td>";
	}


?>
</tr>
</table>
</div>

</div>

