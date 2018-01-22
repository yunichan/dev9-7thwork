<?php 
//フォームのデータ受け取り
$element = $_POST["element"];
$css = $_POST["css"];
$tag = $_POST["tag"];


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
$sql = "INSERT INTO css_t(id, element, css, tag, date) VALUES(NULL, :element, :css, :tag, sysdate())";

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':element', $element, PDO::PARAM_STR);
$stmt->bindValue(':css', $css, PDO::PARAM_STR);
$stmt->bindValue(':tag', $tag, PDO::PARAM_STR);

//実際に実行
$flag = $stmt->execute();

//実行完了した場合はentry.phpにリダイレクト
//失敗した場合はエラーメッセージ表示
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
    echo "送信しました";
    // header('Location: entry.php');
    exit();
}

?>