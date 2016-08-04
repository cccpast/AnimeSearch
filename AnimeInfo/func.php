<?php

/* 無毒化 */
function h($str) {
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/* 文字数チェック */
function countStr($str) {
	if (mb_strlen($str) >= 3) {
		return true;
	}
	return false;
}

/* ソート基準決定 */
function cmpObj($a, $b){
	
	//放送開始時期で比較(strcmpは等しければ0をリターンする)
	$obj = strcmp($a->start_date, $b->start_date);
	
	//放送開始時期同じならタイトルで比較
	if ($obj === 0) {
		$obj = strcmp($a->title, $b->title);
	}

	return $obj;
}

?>