<?php 
//PDOでデータベース接続
try {
	$pdo = new PDO('mysql:host=localhost;dbname=desing_db;charset=utf8','root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}


$sql = 'SELECT*FROM css_t ORDER BY date';

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$flag = $stmt->execute(); 

if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{


    if(empty($_POST)) {
        echo "<a href='top.php'>こちらのページからどうぞ</a>";
        exit();
    }else{
        if (!isset($_POST['id'])  || !is_numeric($_POST['id']) ){
            echo "IDエラー";
            exit();
        }else{
            //プリペアドステートメント
            $id = $_POST['id'];
            $stmt = $pdo->prepare('DELETE FROM css_t WHERE id ="' . $id . '"');
            $stmt->execute();
            header('Location: top.php#disp');
        }
    }
}

?>