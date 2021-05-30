<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>掲示板</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="wrapper">
	<?php
	//返信用フォーム
	if(isset($_POST['repcheck'])){?>
		<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="insert" value="">
		<input type="hidden" name="repid" value="<?php echo $repid;?>">
		<table>
			<tr>
				<td>ニックネーム<input type="text" name="name"></td>
				<td>ジャンル：<?php echo $rcategory;?>
					<input type="hidden" name="category" value="<?php echo $rcategory;?>">
				</td>
			</tr>
			<tr>
				<td>メッセージ<textarea name="msg" id="textarea"></textarea></td>
			</tr>
			<tr>
				<td>画像<input type="file" name="image"></td>
			</tr>
			<tr>
				<td><button type="submit">アップロード</button></td>
			</tr>
		</table>
		</form>

	<?php }
	//通常フォーム
	else{?>
		<form action="index.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="insert" value="">
		<table>
			<tr>
				<td>ニックネーム<input type="text" name="name"></td>
				<td>ジャンル<select name="category">
								<option value="映画">映画</option>
								<option value="本">本</option>
								<option value="音楽">音楽</option>
						</select>
				</td>
			</tr>
			<tr>
				<td>メッセージ<textarea name="msg" id="textarea"></textarea></td>
			</tr>
			<tr>
				<td>画像<input type="file" name="image"></td>
			</tr>
			<tr>
				<td><button type="submit">アップロード</button></td>
			</tr>
		</table>
		</form>
	<?php }?>

	<hr>

	<!-- ジャンル検索 -->
	<form action="" method="post">
	<p>ジャンル選択　<select name="categorysel">
				　		<option value="映画">映画</option>
				　		<option value="本">本</option>
				　		<option value="音楽">音楽</option>
				 　</select>
		<button type="submit">検索</button>
	</p>
	</form>

	<?php 
	//DBに値が入ってる時
	if($date != null){
		foreach($date as $value){ ?>
		<div class="post">
			<?php
			if($value['reply_id'] == 0){ ?>
			<div class="mainpost">
				<p><?php echo $value['id'];?> 
				ニックネーム：<span class="name"><?php echo $value['name'];?></span> 
				ジャンル：<span class="genre"><?php echo $value['category'];?></span> 
				<!-- 投稿日時 -->
				<?php echo $value['post_date'];?>　
				<!-- 返信機能 -->
				<form style="display: inline" action="" method="post">
					<input type="submit" value="返信">
					<input type="hidden" name="repid" value="<?php echo $value['id'];?>">
					<input type="hidden" name="repcheck" value="">
				</form>
				<!-- 削除機能 -->
				<form style="display: inline" action="" method="post">
					<input type="submit" value="削除">
					<input type="hidden" name="delid" value="<?php echo $value['id'];?>">
				</form>
				</p>
				<!-- 投稿メッセージ -->
				<p><?php echo $value['msg'];?></p>
				<!-- 画像存在チェック。存在する場合は表示処理実行-->
				<?php
				$imgname = 'images/'.$value['id'].'.jpg';
				if(file_exists($imgname)){?>
					<img src="images/<?php echo $value['id'];?>.jpg" width="500">
					<br>
			</div>
	<?php 	}}
			//返信投稿表示処理
			foreach($date as $value1){
				if($value1['reply_id'] == $value['id']){?>
				<div class="reply">
					<p>　　<?php echo $value1['id'];?> 
					ニックネーム：<span class="name"><?php echo $value1['name'];?></span> 
					ジャンル：<span class="genre"><?php echo $value1['category'];?></span> 
					<!-- 投稿日時 -->
					<?php echo $value1['post_date'];?>
					</p>
					<!-- 投稿メッセージ -->
					<p>　　<?php echo $value1['msg'];?></p>
					<!-- 画像存在チェック。存在する場合は表示処理実行-->
					<?php
					$imgname = 'images/'.$value1['id'].'.jpg';
					if(file_exists($imgname)){?>
						　　<img src="<?php echo $imgname;?>" width="500">
						<br>
				</div>
	<?php }}} ?></div><?php }
	}
	//DBの値が空の時
	else{?>
		<h1>投稿がありません！</h1>
	<?php }?>
	
</div>
</body>
</html>