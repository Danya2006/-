<?phpinclude('classCases.php');$minUpdTime = 1; // ����������� �����, ����� ������� ����� ��������� �������� ���������				 // �������������� ������ �� ������� ��������� ������ ���������� (���� ���������, ���� ����������)if(rand(0,3) == 1 && filectime('cron_info.php') < time()-$minUpdTime){	$itemsCount = 10; // ���������� ������������ ���������	$operationval = array_rand($arr, 1); // �������� ��� �����	$case = $arr[$operationval];	$random = steamRandom(0, $operationval, $arr);	$cases = $case[$random][3];	$case = $case[$random];	$image = $case[3];	$type = $case[2];	$firstName = $case[0];	/*----------------------------------*/	$name = explode("\r", file_get_contents('fakename.php'));	$v_nickname = trim($name[mt_rand(0, count($name)-1)]);		$arrs = json_decode(file_get_contents('cron_info.php'), true);	$new_tmp = array(				'id' => $arrs[0]['id']+1,				'fake_nickname' => "$v_nickname",				'fake' => '1',				'image' => "$image",				'type' => "$type",				'firstName' => "$firstName",                'v_nickname' => '$v_nickname',				'from_social' => 'vk'			);	$arrsse[] = $new_tmp;		for($i=0; $i<$itemsCount-1; $i++) $arrsse[] = $arrs[$i];		file_put_contents('cron_info.php', '');	$file_hendle = fopen('cron_info.php', 'w'); 	fputs($file_hendle, json_encode($arrsse));	fclose($file_hendle); }include('cron_info.php');function steamRandom($skill, $case, $arr) {	switch ($skill) {		case 0:			$fora = 65;// 0 - 99 + ���� �� ������ ���� �����.			$fora = 10 * $fora; 			$rand = mt_rand($fora, 1000);//�������������� ������			break;		//50		case 1:			$rand = mt_rand(0,1000);//�������������� ������			break;		//70		case 2:			$rand = mt_rand(700,1000);//�������������� ������			break;		//90		case 3:			$rand = mt_rand(999,1000);//�������������� ������			break;	}	if($rand >= 0 && $rand < 797) { // milspec		foreach($arr[$case] as $key => $val)			if($val[2] == 'milspec') $arrs[] = $key;    		return $arrs[rand(0, count($arrs)-1)];  	}	if($rand >= 797 && $rand < 850) { // restricted		foreach($arr[$case] as $key => $val)			if($val[2] == 'restricted')$arrs[] = $key;    		return $arrs[rand(0, count($arrs)-1)]; 	}    if($rand >= 850 && $rand < 971) { // classified		foreach($arr[$case] as $key => $val)			if($val[2] == 'classified')$arrs[] = $key;    		return $arrs[rand(0, count($arrs)-1)];     }	if($rand >= 971 && $rand < 990) { // covert		foreach($arr[$case] as $key => $val)			if($val[2] == 'covert')$arrs[] = $key;    		return $arrs[rand(0, count($arrs)-1)];     }    if($rand >= 990) { // rare 		foreach($arr[$case] as $key => $val)			if($val[2] == 'rare')$arrs[] = $key;    		return $arrs[rand(0, count($arrs)-1)];     }	// ���� ������ �� �����	return rand(0, count($arr[$case])-1);}exit;?>  