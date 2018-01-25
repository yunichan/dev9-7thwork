<?php
$css = $_POST["css"]; 
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
            $id = $_POST['id'];
            // var_dump($id);
            $css = $_POST['css'];
            // var_dump($css);
            $stmt = $pdo->prepare('UPDATE css_t SET css= "' . $css . '" WHERE id = "' . $id . '"');
            // var_dump($stmt);
            $stmt->execute();
            header('Location: top.php#disp');
        }
    }


?>
