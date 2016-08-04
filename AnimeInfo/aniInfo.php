<?php 
/*
 * 出典:メディア芸術データベース（http://mediaarts-db.jp)を加工して作成しております。
 * Animumemo MADB APIを利用
 * https://animumemo.com/doc/api/madb#anime
 */
require_once 'Search.php';
require_once 'func.php';

if (isset($_POST['title']) && $_POST['title'] !== '') {
	$title = h($_POST['title']);
	$media = h($_POST['media']);
	
	// 取得件数をなるべく減らすため文字数チェックを行う
	$flag = countStr($title);
	
	if ($flag) {
		$search = new Search();
		$info = $search->reply($title, $media);
		
		$msg = '検索結果';
	} else {
		$msg = '3文字以上入力してください';
	}
	
} else if(isset($_POST['title']) && $_POST['title'] === '') {
	$msg = '検索する作品タイトルが未入力です';
}

?>
<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>アニメ作品検索</title>
	<link rel="stylesheet" href="CSS/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
	<script src="script.js"></script>
</head>
<body>

<header>
	<h1>アニメ検索システム</h1>
</header>

<div id="cont">

<!-- フォーム領域 -->
<form action="" method="post">
	<label>タイトル、またはタイトルの一部を入力(必須 3文字以上): <input type="text" name="title" autofocus></label>
	
	<p>メディアの形式を選択(複数選択は不可なので、その場合はALLを選択することを推奨)</p>
	<label><input type=radio name="media" value="" checked>ALL</label>
	<label><input type=radio name="media" value="TV">TV</label>
	<label><input type=radio name="media" value="TVスペシャル">TVスペシャル</label>
	<label><input type=radio name="media" value="OVA">OVA</label>
	<label><input type=radio name="media" value="劇場">劇場</label>
	<label><input type=radio name="media" value="イベント">イベント</label>
	<label><input type=radio name="media" value="個人制作">個人制作</label>
	<label><input type=radio name="media" value="その他">その他</label>
	
	<input type="submit" id="btn" value="調べる">
</form>

<!-- メッセージ表示領域 -->
<?php if (!empty($msg)): ?>
	<p><?=h($msg)?></p>
<?php endif; ?>

<!-- 検索結果表示領域 -->
<?php if (!empty($info)): ?>
  <p><?=h($info->total_count)?>件のヒット</p>
  
  <?php if ($info->total_count !== 0): ?>
	  <table>
	  <tr>
		  <th>タイトル</th>
		  <th>放送開始年月日</th>
		  <th>放送終了年月日</th>
		  <th>メディア形式</th>
	  </tr>
	  <?php usort($info->result, "cmpObj"); ?>
	  <?php foreach ($info->result as $val): ?>
	  	<tr>
		    <td><?=h($val->title)?></td>
		    <td><?=h($val->start_date)?></td>
		    <td><?=h($val->end_date)?></td>
		    <td><?=h($val->media)?></td>
	    </tr>
	  <?php endforeach; ?>
	  </table>
  <?php endif; ?>
  
<?php endif; ?>

</div><!-- cont -->

<footer>
	<a href="http://mediaarts-db.jp" target="_blank"><img src="image/ban_small.jpg" alt="メディア芸術データベース"></a>
	<small>出典:メディア芸術データベース（<a href="http://mediaarts-db.jp" target="_blank">http://mediaarts-db.jp</a>)を加工して作成しております</small>
</footer>

</body>
</html>