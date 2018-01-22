<?php 
//PDOでデータベース接続
try {
	$pdo = new PDO('mysql:host=localhost;dbname=desing_db;charset=utf8','root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}

// 実行したいSQL文（最新順番3つ取得）
$sql = 'SELECT*FROM css_t ORDER BY date DESC LIMIT 3';


//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$flag = $stmt->execute(); 


if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">    
    <title>input</title>
    
<style>
    html,body{
        width: 100%;
        height: 100%;
        font-family: Roboto,Arial,sans-serif;
        scroll-behavior: smooth;
        margin:0;
    }
    #top{
        width: 100%;
    }
    #toptext{
        text-align: center;
        margin-top: 6%;
        color: #fff;
        font-family: cursive;
        width: 100%;
        position: absolute;
        z-index: 10;
        font-size: 50px;
    }
    #topimg{
        width: 100%;
        height: auto;
        animation: big 20s ease;
    }
    @keyframes big{
        0%{
            transform: scale(1) translateY(0);
        }
        100%{
            transform: scale(1.05) translateY(-3%);
        }
    }

    .container{
        width: 100%;
        height: 100%;
        text-align:center;
    }

    form{
        display:flex;
        flex-direction:column;
        width:60%;
        margin:auto;
        text-align:center;
    }
    label,textarea,input{
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    
    ul{
        width: 100%;
        height: 100%;
    }
    li{
        width: 100%;
        display: flex;
        background:#333333;
    }
    .disp{
        width: 30%;
        height: 100px;
        background: #aaaaaa;
        border: solid 1px;
    }
    .content{
        width: 70%;
        height: 100px;
        overflow: auto;
        background: #ffbbbb;
    }
    
    #input{
        width: 100%;
        height: 100px;
        background: #ff8888;
        z-index: 10;
    }

    #elem{
        width: 200px;
        height: 200px;
        border: 1px solid #000000;
    }



</style>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="top">
        <div id="toptext">animation memo</div>
        <img src="img1.jpg" alt="" id="topimg">
    </div>


    <div class="container">
        <h1>登録</h1>
        <form action="insert.php" method="post">
            <label for="title">html</label>
            <textarea type="element" name="element" id="element" style="resize:none"></textarea>
            <label for="title">ccs</label>
            <textarea name="css" id="css" cols="30" rows="10" class="uk-textarea" style="resize:none"></textarea>
            <label for="title">comment</label>
            <textarea name="tag" id="tag" cols="30" rows="1" class="uk-textarea" style="resize:none"></textarea>
            <input type="submit" value="送信">
        </form>    
    </div>


    <?php
        $file_name = './style.css';
        if(file_exists($file_name)){
            unlink($file_name);
        }
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $file = fopen($file_name,"a");	// ファイル読み込み
            flock($file, LOCK_EX);			// ファイルロック
            fwrite($file, $result['css']."\n"); // "\n"は改行コード
            flock($file, LOCK_UN);			// ファイルロック解除
            fclose($file);
            ?>
    <div id=elem>
        <?php echo $result['element'];?>
    </div>
    <pre>
        <?php echo $result['css'];?>
    </pre>

    <?php }?>
    
</body>
</html>

<?php 
}
?>