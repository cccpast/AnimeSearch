<?php
/* 検索クラス */
class Search{
	
	/* JSON取得 (title以外はデフォルトで無指定 )*/
	private function getAnimeInfo($title, $media='', $start_date='', $end_date='') {
		// URL改行しないように注意&&start_dateとend_dateはstring型
		$url = "https://api.animumemo.com/madb/anime/search?fields=title,media,start_date,end_date&title={$title}&media={$media}&start_date={$start_date}&end_date={$end_date}";
	
		if (!($data = @file_get_contents($url))) {
			return false;
		}
		
		// JSONを連想配列として扱う場合は第二引数にtrueを渡すが、ここではオブジェクトとして扱う
		return json_decode($data);
	}
	
	/* JSONリターン*/
	public function reply($title) {
		$json = $this->getAnimeInfo($title);
		sleep(1); // 処理時間遅延
		return $json;
	}
		
}

?>