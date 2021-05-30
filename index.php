<?php
    //"config.php"を読み込む
    require_once "config.php";

    //DB接続（関数）
    function connect_db(){
        $cn = mysqli_connect(HOST,DB_USER,DB_PASS,DB_NAME);
        if (mysqli_connect_errno()) {
            die('データベースに接続できませんでした。');
        }
        mysqli_set_charset($cn, 'utf8');
        return $cn;
    }

    //DBから投稿内容を読み込み（関数）
    function select(){
        $cn = connect_db(); //DB接続
        $sql = "SELECT id,name,msg,category,post_date,reply_id FROM t_post WHERE del_flg = 0;";
        $date = mysqli_query($cn,$sql);
        $array = []; //$array[]を宣言
        while($row = mysqli_fetch_assoc($date)){
            $array[] = $row;
        }
        
        mysqli_close($cn);
        return array_reverse($array);
    }

    //DBからMAX(id)を取り出す（関数）
    function maxid(){
        $cn = connect_db();
        $sql = "SELECT MAX(id) as id FROM t_post;";
        $date = mysqli_query($cn,$sql);
        $max = mysqli_fetch_assoc($date);
        mysqli_close($cn);
        $maxid = $max['id'];
        return $maxid;
    }

    //返信ボタン押した時
    if(isset($_POST['repid'])){
        $repid = $_POST['repid'];
        $cn = connect_db();
        $sql = "SELECT category FROM t_post WHERE id = '$repid';";
        $date = mysqli_query($cn,$sql);
        $cat = mysqli_fetch_assoc($date);
        mysqli_close($cn);
        $rcategory = $cat['category'];
    }
    //それ以外
    else{
        $repid = '0';
    }

    //POSTで送られてきた時実行
    if(isset($_POST['insert'])){
        $name = $_POST['name'];
        $category = $_POST['category'];
        $msg = $_POST['msg'];

        //var_dump($_POST['insert']);

        //$upload_file = $_FILES['upload_file'];
        
        //DBに登録
        $cn = connect_db();
        //$sql = "INSERT INTO t_post(name,msg,category,reply_id,del_flg,post_date)
                //VALUES('$name', '$msg', '$category', '0', '0', now());";
        $sql = "INSERT INTO t_post(id,name,msg,category,reply_id,del_flg,post_date)
                SELECT MAX(id) + 1, '$name', '$msg', '$category', '$repid', '0', now()
                FROM t_post;";
        mysqli_query($cn,$sql);
        mysqli_close($cn);

        //投稿内容を変数に代入
        $date = select();

        //MAX(id)を画像のファイル名に設定
        $filename = maxid().'.jpg';
        //画像アップロード処理
        move_uploaded_file($_FILES['image']['tmp_name'],UPLOAD_PATH.$filename);
    }

    //返信ボタンを押した時実行
    //elseif(isset($_GET['repid'])){
        //投稿内容を変数に代入
        //$date = select();
    //}

    //削除ボタンを押した時実行
    elseif(isset($_POST['delid'])){
        $delid = $_POST['delid'];

        //del_flgを1に更新
        $cn = connect_db();
        $sql = "UPDATE t_post SET del_flg=1 WHERE id='$delid';";
        mysqli_query($cn,$sql);
        mysqli_close($cn);

        //投稿内容を変数に代入
        $date = select();
    }

    //ジャンル検索した時
    elseif(isset($_POST['categorysel'])){
        $categorysel = $_POST['categorysel'];

        $cn = connect_db();
        $sql = "SELECT id,name,msg,category,post_date,reply_id FROM t_post WHERE del_flg = 0 AND category ='$categorysel';";
        $date = mysqli_query($cn,$sql);
        while($row = mysqli_fetch_assoc($date)){
            $arr[] = $row;
        }
        mysqli_close($cn);
        $array = array_reverse($arr);

        //投稿内容を変数に代入
        $date = $array;
    }
    
    //index.phpを開いた時に投稿内容を読み込む
    else{
        //投稿内容を変数に代入
        $date = select();
    }



    //"tpl/index.php"を読み込む
    require_once "tpl/index.php";
?>
