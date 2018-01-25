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
        color:#929292;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        background-image:url(img3.jpg);
        background-size:cover;
    }
    #comnt{
        display:flex;
        justify-content:center;
        align-items:center;
        color:#fff;
    }
    #back{
        width:20vw;
        height:7vh;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:100px;
        color:#fff;
        background:#3e3d3d;
        margin:3vh;
        -webkit-transition: all .5s ease;
        -moz-transition: all .5s ease;
        transition: all .5s ease;
    }
    #back:hover{
        background:#d47a93;
    }
    a{
        text-decoration:none;
    }
</style>
</head>
<body>

<?php 
//フォームのデータ受け取り
$element = $_POST["element"];
$css = $_POST["css"];


//DB定義
const DB = "";
const DB_ID = "";
const DB_PW = "";
const DB_NAME = "";

//PDOでデータベース接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=desing_db;charset=utf8','root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}

// 実行したいSQL文
$sql = "INSERT INTO css_t(id, element, css, date) VALUES(NULL, :element, :css, sysdate())";

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':element', $element, PDO::PARAM_STR);
$stmt->bindValue(':css', $css, PDO::PARAM_STR);

//実際に実行
$flag = $stmt->execute();

//実行完了した場合はentry.phpにリダイレクト
//失敗した場合はエラーメッセージ表示
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
?>
<div id="comnt">
    <?php echo "登録しました";?>
</div>
<a href="./top.php">
<div id="back">戻る</div>
</a>
<?php
exit();
}

?>

</body>
</html>